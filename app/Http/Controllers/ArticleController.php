<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\Article as ArticleResources;

class ArticleController extends Controller
{
    function __construct(Article  $article){
        $this->article = $article;
    }
    
    public function index(){

        return new ArticleResources(Article::paginate(10));
    }

    public function store(Request $request){
        
        return new ArticleResources(Article::create($request->all())->toArray());
    }

    public function edit(Request $request,Article $article){
        if($article->update($request->input())){
            return json_encode(['status'=>200,'data' => []]);
        }
        return json_encode(['status'=>500,'data'=>[],'message'=>'保存失败']);
    }


    public function destroy(Article $article){
        $article->delete();
        return json_encode(['status'=>200,'data'=>[],'message'=>'删除成功']);
    }
}
