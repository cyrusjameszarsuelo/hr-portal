<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corporate_Office extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'corporate_office';
}

