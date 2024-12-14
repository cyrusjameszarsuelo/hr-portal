<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class New_Hires extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    protected $table = 'new_hires';

    public function content_type()
    {
        return $this->belongsTo(Content_Type::class);
    }
}
