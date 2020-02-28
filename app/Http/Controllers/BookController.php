<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //

    public function store(Request $request){

        $book = Book::create($this->validateRequest($request));

        return redirect($book->path());
    }


    public function update(Book $book,Request $request){

        $book->update($this->validateRequest($request));

        return redirect($book->path());
    }

    public function validateRequest(Request $request){
        return $request->validate([
            'title'     => 'required',
            'author'    => 'required'
        ]);
    }

    public function delete(Book $book){
        // Book::destroy($id);
        $book->delete();

        return redirect($book->path());
    }

}
