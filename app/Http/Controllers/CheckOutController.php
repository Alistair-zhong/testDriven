<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(Book $book){
        $book->checkout(auth()->user());

    }
}
