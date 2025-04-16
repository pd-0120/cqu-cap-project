<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CognifitCognitiveAssessmentList extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'description',
        'image',
        'estimated_time',
        'response_data',
        'type',
    ];
}
