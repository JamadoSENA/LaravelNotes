<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = DB::table('comments')
                    ->join('articles', 'comments.article_id', '=', 'articles.id')
                    ->join('users', 'comments.user_id', '=', 'users.id')
                    ->select('comments.value', 'comments.description',
                    'articles.title', 'users.full_name')
                    ->where('articles.user_id', '=', Auth::user()->id)
                    ->orderBy('articles.id', 'desc')
                    ->get();

        return view('admin.comments.index', compact('comments'));           
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        //Verificar si en el articulo ya existe un comentario del usuario
        $result = Comment::where('user_id', Auth::user()->id)->where('article_id', $request->article_id)->exists();

        //Consulta para obtener slug y estado del articulo comentado
        $article = Article::select('status', 'slug')->find($request->article_id);

        //Si no existe y si el estado del articulo es publico, comentar. Si no enviar 404.
        if(!$result and $article->status == 1){
            Comment::create([
                'value' => $request->value,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'article_id' => $request->article_id,
            ]);
            return redirect()->action([ArticleController::class, 'show'], [$article->slug]);
        }else{
            return redirect()->action([ArticleController::class, 'show'], [$article->slug])
            ->with('success-error', 'Solo puedes comentar una vez');
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        //Redireccionar al index
        return redirect()->action([CommentController::class, 'index'], compact('comment'))
        ->with('success-delete', 'Comentario eliminado.');
    }
}
