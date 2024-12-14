<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hmo_Announcement extends Model
{
    use HasFactory;

    protected $table = 'hmo_announcement';

    public function content_type()
    {
        return $this->belongsTo(Content_Type::class);
    }
}
