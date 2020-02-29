<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use App\Models\Author;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;


class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_book_can_be_checked_out(){
        // 获取到书籍 和 用户
        $book   = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        
        // 进行checked_out 
        $book->checkout($author);

        // 判断记录表中应该有了一条记录 且其记录与书籍和用户有关
        $this->assertCount(1,Reservation::get());
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertEquals($author->id,Reservation::first()->author_id);
        $this->assertequals(now(),Reservation::first()->checked_out_at);
    }

    /**
    *@test
    */
    public function a_book_can_be_returned(){
        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();

        $book->checkout($author);

        $book->checkin($author);

        $book->checkout($author);

        $this->assertCount(2,Reservation::get());
        $this->assertEquals($author->id,Reservation::find(1)->author_id);
        $this->assertEquals($book->id,Reservation::find(1)->book_id);
        $this->assertNotNull(Reservation::find(1)->checked_in_at);
        $this->assertEquals(now(),Reservation::find(1)->checked_in_at); 

        $book->checkin($author);
        $this->assertCount(2,Reservation::get());
        $this->assertEquals($author->id,Reservation::find(2)->author_id);
        $this->assertEquals($book->id,Reservation::find(2)->book_id);
        $this->assertNotNull(Reservation::find(2)->checked_in_at);
        $this->assertEquals(now(),Reservation::find(2)->checked_in_at); 


    }

    /**
    *@test
    */
    public function if_not_checked_out_exception_is_thrown(){
        
        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        
        
        $this->expectException(\Exception::class);
        $book->checkin($author);
    }

}
