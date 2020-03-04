<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    function __construct(Author $author){
        $this->author = $author;
    }
    //
    protected $guarded = [];
}
