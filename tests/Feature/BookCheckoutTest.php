<?php

namespace Tests\Feature;

use App\Book;
use App\User;
use Tests\TestCase;
use App\Models\Author;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookCheckoutTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    public function a_book_can_be_checked_out_by_a_singed_in_user(){
        $this->withoutExceptionHandling();
        $book = factory(Book::class)->create();

        // 登录一个用户 测试checked_out
        $this->actingAs($user = factory(User::class)->create())
            ->post('/books/checkedout/' . $book->id);


        $this->assertCount(1,Reservation::get());
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertEquals($user->id,Reservation::first()->author_id);
        $this->assertequals(now(),Reservation::first()->checked_out_at);
    }

    /**
    *@test
    */
    public function only_singed_in_users_can_checkout_a_book(){

        $book = factory(Book::class)->create();

        // 登录一个用户 测试checked_out
        $this->post('/books/checkedout/' . $book->id)
            ->assertRedirect('login');


        $this->assertCount(0,Reservation::get());
    }

    /**
    *@test
    */
    public function only_real_book_can_be_checked_out(){
        $this->actingAs($user = factory(User::class)->create())
            ->post('/books/checkedout/123')
            ->assertStatus(404);

        $this->assertCount(0,Reservation::all());
    }

    /**
    *@test
    */
    public function a_book_can_be_checked_in_by_a_singed_in_user(){
        $this->withoutExceptionHandling();
        
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->post('/books/checkedout/' . $book->id);

        $this->actingAs($user)
             ->post('/books/checkedin/' . $book->id);
        
        $this->assertCount(1,Reservation::get());
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertEquals($user->id,Reservation::first()->author_id);
        $this->assertequals(now(),Reservation::first()->checked_out_at);
        $this->assertequals(now(),Reservation::first()->checked_in_at);
    }


    /**
    *@test
    */
    public function only_singed_in_user_can_checkin_a_book(){

        // 模拟用户登录 并checkin一本书
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user)
             ->post('books/checkedout/' . $book->id);

        Auth::logout();
        
        $this->post('books/checkedin/' . $book->id)
             ->assertRedirect('/login');

        $this->assertCount(1,Reservation::get());

        $this->assertNull(Reservation::first()->checked_in_at);

    }


    /**
    *@test
    */
    public function only_real_book_can_be_checked_in(){
        $this->actingAs($user = factory(User::class)->create())
            ->post('/books/checkedin/123')
            ->assertStatus(404);

        $this->assertCount(0,Reservation::all());
    }


    /**
    *@test
    */
    public function a_404_is_thrown_if_a_book_is_not_checked_out_first(){
        $this->withoutExceptionHandling();
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->post('/books/checkedin/' . $book->id)
             ->assertStatus(404);
            
        $this->assertCount(0,Reservation::all());
    }   
}
