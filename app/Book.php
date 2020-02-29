<?php

namespace App;

use App\Models\Author;
use App\Models\Reservation;
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


    public function checkout(Author $author){
        // 在Reservation 表中增加一条记录  包含当前book和author的id
        $this->reservations()->create([
            'author_id'     => $author->id,
            'book_id'       => $this->id,
            'checked_out_at'=>  now()
        ]);
    }

    public function checkin(Author $author){
        $reservation = $this->reservations()
                            ->where('author_id',$author->id)
                            ->whereNotNull('checked_out_at')
                            ->whereNull('checked_in_at')
                            ->first();
        
        if(null === $reservation){

        }
        
        $reservation->update(['checked_in_at'=>now()]);
    }


    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

}
