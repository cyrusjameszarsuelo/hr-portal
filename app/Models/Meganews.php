<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meganews extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function content_type()
    {
        return $this->belongsTo(Content_Type::class);
    }

    public function meganews_image()
    {
        return $this->hasMany(Meganews_Image::class);
    }
}
