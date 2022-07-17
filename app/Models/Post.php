<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['web_id','title','body'];

    public function website(){
        return $this->hasOne(Website::class,'id','web_id');
    }
}
