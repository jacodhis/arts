<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class at extends Model
{
    use HasFactory;

protected $fillable =[];    

public function user(){
    return $this->belongsTo('App\Models\User');
}

public function comments(){
    return $this->morphMany(chat::class,'commentable');
}


}
