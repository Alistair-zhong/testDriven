<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *@test
     * @return void
     */
    public function a_book_can_be_added_to_the_library()
    {
          $this->withoutExceptionHandling();

          $response = $this->post('/books',[
              'title' => 'Cool Book Ttile',
              'author'=> 'Victor',
          ]);

          $response->assertOk();
          $this->assertCount(1,Book::all());
    }

    /**
     * @test
     */
    public function is_title_data_required()
    {
        // $this->withoutExceptionHandling();

          $response = $this->post('/books',[
              'title'   => '',
              'author'  => "fdd",
          ]);

          $response->assertSessionHasErrors('title');
    }


    /**
     * @test
     */
    public function is_author_data_required()
    {
        // $this->withoutExceptionHandling();

          $response = $this->post('/books',[
              'title'   => 'vji',
              'author'  => "",
          ]);

          $response->assertSessionHasErrors('author');
    }

    /**
     * 测试更新书籍
     * @test
     */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();

        $response = $this->post('/books',[
            'title' => 'Cool Book Ttile',
            'author'=> 'Victor',
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id,[
            'title'     => 'new title',
            'author'    => 'justin'
        ]);
        
        $this->assertEquals('new title',Book::first()->title);
        $this->assertEquals('justin',Book::first()->author);

    }
}
