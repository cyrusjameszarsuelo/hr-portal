<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choices extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'choices';
}
