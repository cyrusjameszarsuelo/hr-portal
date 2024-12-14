<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcements extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'announcements';

    public function content_type()
    {
        return $this->belongsTo(Content_Type::class);
    }

    public function announcements_images()
    {
        return $this->hasMany(Announcements_Images::class);
    }
}
