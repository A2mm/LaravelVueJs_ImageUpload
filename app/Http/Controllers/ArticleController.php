<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function formSubmit(Request $request)
    {
        $article = new Article;
        $article->title = 'test title';
        $article->body  = 'test body';

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $path = $request->image->move(public_path('images'), $imageName);   
        $article->image  = $imageName;   
        if($article->save()) {
            return response()->json([
                'success' =>'You have successfully upload image.',
                'path'    => $imageName,
                'id'      => $article->id,
                'article' => $article,
            ]);
        }
    }
}
