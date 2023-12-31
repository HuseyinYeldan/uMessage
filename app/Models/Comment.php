<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'content', 'parent_id','post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function recursiveReplies()
    {
        return $this->replies()->with('recursiveReplies');
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function likes(){
        return $this->hasMany(Like::class, 'content_id')->where('isComment', 1);
    }
}
