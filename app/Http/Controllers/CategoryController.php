<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mostrar los Categorias en el Admin
        $categories = Category::orderBy('id','desc')
                        ->simplePaginate(8);


        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();

        //Validar si hay un archivo
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        }

        //Guardar informacion
        Category::create($category);

        //Redireccionar al index
        return redirect()->action([CategoryController::class, 'index'])
        ->with('success-create', 'Categoria creado.');
    }

    /*
    Display the specified resource.
    
    public function show(Category $category)
    {
        
    }*/

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //Si el usuario sube una imagen
        if($request->hasFile('image')){
            //Eliminar imagen anterior
            File::delete(public_path('storage/' . $category->image));
            //Asignar nueva imagen
            $category['image'] = $request->file('image')->store('categories');
        }

        //Actualizar datos
        $category->update([
            'name'=> $request->name,
            'slug'=> $request->slug,
            'status'=> $request->status,
            'is_featured'=> $request->is_featured,
        ]);

        //Redireccionar al index
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
        ->with('success-update', 'Category modificado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //Eliminar imagen de la Categoria
        if($category->image){
            File::delete(public_path('storage/' . $category->image));
        }

        //Eliminar la Categoria
        $category->delete();

        //Redireccionar al index
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
        ->with('success-delete', 'Categoria eliminada.');
    }

    //Filtrar articulos por Categorias
    public function detail(Category $category)
    {
        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']
        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);
        
        return view('subscriber.categories.detail' , compact('articles', 'category', 'navbar'));

    }
}
