<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Author extends Model 
{
    //
    protected $guarded = [];

    protected $dates = ['birth'];

    public function setBirthAttribute($value){
        $this->attributes['birth'] = Carbon::parse($value);
    }

}
