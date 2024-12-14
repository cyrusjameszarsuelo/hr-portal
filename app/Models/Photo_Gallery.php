<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo_Gallery extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'photo_gallery';
}
