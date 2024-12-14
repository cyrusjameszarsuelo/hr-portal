<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    protected $table = 'blog';

    public function blog_images()
    {
        return $this->hasMany(Blog_Images::class);
    }

    public function content_type()
    {
        return $this->belongsTo(Content_Type::class);
    }

    public function blog_comments()
    {
        return $this->hasMany(Blog_Comments::class);
    }
}
