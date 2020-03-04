<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    public function look_articles_by_api(){
        $this->withoutExceptionHandling();

        factory(Article::class,30)->create();

        // 提交get请求
        $data = $this->get('api/articles')
            ->assertOk()
            ->decodeResponseJson()["data"];

        // 获取到10条记录信息   分页 每页十条
        $this->assertCount(10,$data);
    }

    /**
    *@test
    */
    public function store_a_article_by_post_api(){
        $this->withoutExceptionHandling();

        $this->assertCount(0,Article::get());

        $response = $this->post('api/articles',[
            'title'     => "this is a good day?",
            'content'   => "this is a good day? yes,I am going to swimming for this."
        ])->assertOk();

        $this->assertCount(1,Article::get());
    }


    /**
    *@test
    */
    public function a_article_can_be_update(){
        $this->withoutExceptionHandling();
        // 先创建一篇文章
        $article = factory(Article::class)->create();
        // 提交put请求进行更新
        $response = $this->put('api/articles/'.$article->id,[
            'id'    => $article->id,
            'title' => 'new title',
        ])
        ->assertOk();
        // 判断更新后的数据记录是否和提交数据相同
        $this->assertCount(1,Article::all());
        $this->assertEquals('new title',Article::first()->title);
        $this->assertEquals($article->id,Article::first()->id);
    }

    /**
    *@test
    */
    public function a_article_can_be_delete(){
        $this->withoutExceptionHandling();
        // 先获取到一篇文章
        $article = factory(Article::class)->create();
        $preCount = Count(Article::get());
            
        // 提交delete请求，删除改文章
        $this->delete('api/articles/' . $article->id);
        
        // 数据库中的数量比之前少一
        $nowCount = Count(Article::get());
        $this->assertEquals($preCount - 1,$nowCount);
    }




}
