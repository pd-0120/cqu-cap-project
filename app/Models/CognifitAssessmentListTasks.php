<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CognifitAssessmentListTasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'assessment_list_id',
    ];

    public function CognifitCognitiveAssessment() {
        return $this->belongsTo(CognifitCognitiveAssessmentList::class, 'assessment_list_id', 'id');
    }
}
