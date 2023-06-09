<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index',[
            'articles'=>Article::get()
        ]);
    }

    public function create()
    {
        return view('article.form');
    }

    public function store(Request $request)
    {
        $inputs = $request->only(['title','description']);
        $create = Article::create($inputs);

        if($create){
            return redirect()-> route('article.index');
        }

        return abort(500);
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('article.form',[
            'article'=>$article
        ]);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->only(['title','description']);
        $article = Article::find($id);
        $update = $article->update($inputs);

        if($update){
            return redirect()-> route('article.index');
        }

        return abort(500);
    }     
    
    public function destroy( $id)
    {
        $article = Article::find($id);
        $delete = $article->delete();

        if($delete){
            return redirect()-> route('article.index');
        }

        return abort(500);
    }  
    
}
