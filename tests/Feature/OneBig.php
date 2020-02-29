<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OneBig extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     */
    public function test_big_deal()
    {
        $response = $this->get('/');
        dd("fdsf");
        $response->assertStatus(200);
    }
    
    /**
    *@test
    */
    public function i_dont_konw_why(){
        $this->factory(Book::class)->create();
        $this->assertCount(1,Book::get());
    }
}
