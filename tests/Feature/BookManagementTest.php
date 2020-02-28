<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
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

          $book = Book::first();

          $this->assertCount(1,Book::all());
          $response->assertRedirect($book->path());
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
        
        $response->assertRedirect($book->path());
    }


    /**
     * @test
     */
    public function a_book_can_be_deleted(){
        $this->withoutExceptionHandling();
        // 先获取到一篇book
        $response = $this->post('/books',[
            'title' => 'Cool Book Ttile',
            'author'=> 'Victor',
        ]);

        $book = Book::first();
        $this->assertCount(1,Book::get());
        
        // 传递给控制器
        $response = $this->delete('/books/' . $book->id);

        // 检测返回值 预测是重定向到列表页
        $response->assertRedirect($book->path());

        // 最终数量为0
        $this->assertCount(0,Book::get());
        
    }


}
