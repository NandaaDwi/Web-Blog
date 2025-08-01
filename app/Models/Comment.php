<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{  
    protected $fillable = ['article_id', 'user_id', 'content', 'body'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
