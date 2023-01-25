<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPosts extends Model
{
    protected $fillable = ['title', 'content'];

    use HasFactory;


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}