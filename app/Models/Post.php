<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
// In the Post model
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // In the Comment model
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'content_id');
    }
}
