<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
    *@test
    */
    public function create_some_articles_by_factory(){
        factory(Article::class,30)->create();

        $this->assertCount(30,Article::get());
    }
}
