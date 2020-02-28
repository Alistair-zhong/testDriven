<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //
    public function add(Request $request){
        $author = Author::create($request->only(['name','birth']));
        return ;
    }
}
