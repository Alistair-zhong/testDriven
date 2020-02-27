<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $table = 'authors';

    protected $fillable = ['age','name'];

    function posts(){
        return $this->hasMany(Post::class);
    }
}
