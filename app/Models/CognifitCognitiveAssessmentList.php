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

    public function getTasks() {
        return $this->hasMany(CognifitAssessmentListTasks::class, 'assessment_list_id', 'id');
    }

    public function getSkills() {
        return $this->hasMany(CongnifitAssessmentListSkills::class, 'assessment_list_id', 'id');
    }
}
