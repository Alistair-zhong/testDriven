<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        // App\Models\Article::class => App\Models\Author::class,
    ];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //====== 测试instance方法
    //    $article = new \App\Models\Article();
    //    $article->title = 'only one tilte';
    //    $article->content = 'only one content';
    //    $this->app->instance('Article',$article);
       
    //    $this->app->bind('\App\Http\Controllers\ArticleController',function($app){
    //            return new \App\Http\Controllers\ArticleController($app->make('Article'));
    //        });
           //====== 测试Binding Primitives
        //    $this->app->when('\App\Http\Controllers\ArticleController')
        //    ->needs('$article')
        //    ->give(factory(\App\Models\Article::class)->create());
    }
}
