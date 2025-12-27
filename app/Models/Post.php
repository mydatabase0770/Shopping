<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

        protected $fillable = [
        'title',
        'price',
        'description',
        'color',
        'size',
        'image',
        'discount',
    ];

    public function getFinalPriceAttribute()
    {
        if ($this->discount && $this->discount > 0) {
            return $this->price - ($this->price * $this->discount / 100);
        }

        return $this->price;
    }

    /**
     * Relations
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories')
                    ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
