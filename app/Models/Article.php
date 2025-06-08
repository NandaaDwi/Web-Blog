<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'content', 'thumbnail', 'is_published'];

    protected static function boot()
    {
        
        parent::boot();

        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);

            $count = static::where('slug', 'like', $article->slug . '%')->count();
            if ($count > 0) {
                $article->slug = $article->slug . '-' . ($count + 1);
            }
        });
    }

    protected static function booted()
    {
        static::creating(function ($article) {
            $article->slug = Str::slug($article->title) . '-' . Str::random(5);
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }
}
