<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorandum extends Model
{
    use HasFactory;

    protected $table = 'memorandum';

    public function content_type()
    {
        return $this->belongsTo(Content_Type::class);
    }
}
