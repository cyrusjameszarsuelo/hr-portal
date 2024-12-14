<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'timeline';

    public function post_type()
    {
        return $this->belongsTo(Post_Type::class);
    }

    public function timeline_comments()
    {
        return $this->hasMany(Timeline_Comments::class);
    }
}
