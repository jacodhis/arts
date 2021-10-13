<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    use HasFactory;

    public function commentable(){
    	return $this->morphTo();
    }
     public function user(){
          return $this->belongsTo('App\Models\User');
     }
     public function comments(){
          return $this->morphMany(chat::class,'commentable')->orderBy('created_at','desc');
     }
}
