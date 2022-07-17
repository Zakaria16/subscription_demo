<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $fillable=['url'];

    public function subscriptions(){
        return $this->hasMany(Subscription::class,'web_id','id');
    }
}
