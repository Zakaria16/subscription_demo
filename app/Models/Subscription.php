<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['userid','web_id'];

    public function user(){
        return $this->hasOne(User::class,'id','userid');
    }
}
