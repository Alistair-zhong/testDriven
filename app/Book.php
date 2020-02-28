<?php

namespace App;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = ['title','author_id'];
    
    protected $guarded = [];

    public function path(){
        return '/books/' . $this->id;
    }


    public function setAuthorIdAttribute($val){
        $this->attributes['author_id'] = Author::firstOrCreate([
            'name' => $val,
            ])->id;
    }

}
