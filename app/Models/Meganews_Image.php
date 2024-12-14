<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meganews_Image extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'meganews_image';

    // public function meganews()
    // {
    //     return $this->belongsToMany(Meganews::class);
    // }
}
