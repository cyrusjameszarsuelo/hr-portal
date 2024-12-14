<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'survey';

    public function choices()
    {
        return $this->hasMany(Choices::class);
    }

    public function survey_answer() 
    {
        return $this->hasMany(SurveyAnswer::class);
    }
}
