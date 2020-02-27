<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    protected $fillable = ['content','author_id','title'];

    function author(){
        return $this->belongsTo(Author::class);
    }
}
