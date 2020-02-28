<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    public function a_book_can_be_created(){
        $book = Book::create([
            'title' => 'Cool Book Ttile',
            'author_id'=> 'Victor',
        ]);

        $this->assertCount(1,Book::get());
    }       
}
