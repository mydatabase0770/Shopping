<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','user_id','state'];


    public function post(){
        return $this->belongsTo(Post::class , 'post_id');
    }
        public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
