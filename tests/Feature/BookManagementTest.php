<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use App\Models\Author;
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

          $response = $this->post('/books',$this->getData());

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

          $response = $this->post('/books',array_merge($this->getData(),['title'=> '']));

          $response->assertSessionHasErrors('title');
    }


    /**
     * @test
     */
    public function is_author_data_required()
    {
        // $this->withoutExceptionHandling();

          $response = $this->post('/books',array_merge($this->getdata(),['author_id'=>'']));

          $response->assertSessionHasErrors('author_id');
    }

    /**
     * 测试更新书籍
     * @test
     */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();

        $response = $this->post('/books',$this->getData());

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id,[
            'title'     => 'new title',
            'author_id'    => 'justin'
        ]);
        
        $this->assertEquals('new title',Book::first()->title);
        $this->assertEquals(2,Book::first()->author_id);
        
        $response->assertRedirect($book->path());
    }


    /**
     * @test
     */
    public function a_book_can_be_deleted(){
        $this->withoutExceptionHandling();
        // 先获取到一篇book
        $response = $this->post('/books',$this->getData());

        $book = Book::first();
        $this->assertCount(1,Book::get());
        
        // 传递给控制器
        $response = $this->delete('/books/' . $book->id);

        // 检测返回值 预测是重定向到列表页
        $response->assertRedirect($book->path());

        // 最终数量为0
        $this->assertCount(0,Book::get());
        
    }

    /**
    *@test
    */
    public function a_new_author_is_automatically_added(){

        $this->withoutExceptionHandling();
        // 用户提交的书本信息时，能通过填写的作者名字来获取对应的作者信息
        $this->post('/books',[
            'title' => 'Cool Book Ttile',
            'author_id'=> 'Victor',
        ]);

        // 此时应有一本书和一个作者
        $book   = Book::first();
        $author = Author::first();

        $this->assertCount(1,Book::get());
        $this->assertCount(1,Author::get());
        // 且作者的id和书的作者id是相同的
        $this->assertEquals($author->id,$book->author_id);
    }

    private function getData(){
        return [
            'title' => 'Cool Book Ttile',
            'author_id'=> 'Victor',
        ];
    }

}
