<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'video_url',
        'excerpt',
        'content',
        'category',
        'is_published'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
