<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mostrar los Articulos en el Admin
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)
                    ->orderBy('id','desc')
                    ->simplePaginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Obtener Categorias Publicas
        $categories = Category::select(['id','name'])
                        ->where('status','1')
                        ->get();
        
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        //Combinar el user_id con datos que vienen en la solicitud
        $request->merge([
            'user_id' => Auth::user()->id
        ]);

        //Guardo la solicitud en una variable
        $article =$request->all();

        //Validar si hay un archivo en el request
        if($request->hasFile('image')){
            $article['image'] = $request->file('image')->store('articles');
        }

        //Metodo para guardar la informacion
        Article::create($article);

        //Redireccionar al index
        return redirect()->action([ArticleController::class, 'index'])
        ->with('success-create', 'Articulo creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = $article->comments()-simplePaginate(5);

        return view('subscriber.articles.show', compact('article','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //Obtener Categorias Publicas
        $categories = Category::select(['id','name'])
                        ->where('status','1')
                        ->get();
        
        return view('admin.articles.edit', compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        //Si el usuario quiere subir una nueva imagen
        if($request->hasFile('image')){
            //Eliminar imagen anterior
            File::delete(public_path('storage/' . $article->image));
            //Asigna imagen nueva
            $article['image'] = $request->file['image']->store('articles');
        }

        //Actualizar datos
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,   
            'status' => $request->status, 
        ]);

        //Redireccionar al index
        return redirect()->action([ArticleController::class, 'index'], compact('article'))
        ->with('success-update', 'Articulo modificado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //Eliminar imagen del Articulo
        if($article->image){
            File::delete(public_path('storage/' . $article->image));
        }

        //Eliminar el Articulo
        $article->delete();

        //Redireccionar al index
        return redirect()->action([ArticleController::class, 'index'], compact('article'))
        ->with('success-delete', 'Articulo eliminado.');
    }
}
