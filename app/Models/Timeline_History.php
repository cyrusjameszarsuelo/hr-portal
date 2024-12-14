<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline_History extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'timeline_history';

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }
}
