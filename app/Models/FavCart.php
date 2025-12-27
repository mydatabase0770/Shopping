<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavCart extends Model
{
    //
    use HasFactory;
    
    public const FAVORITE = 0;
    public const CART = 1;
    protected $fillable = ['user_id','post_id','state'];


    public function post()
{
    return $this->belongsTo(Post::class, 'post_id');
}

}
