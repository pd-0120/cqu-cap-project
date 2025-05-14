<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CongnifitAssessmentListSkills extends Model
{
    use HasFactory;
	use LogsActivity;
    protected $fillable = [
        'name',
        'assessment_list_id',
    ];
	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults();
	}
    public function CognifitCognitiveAssessment() {
        return $this->belongsTo(CognifitCognitiveAssessmentList::class, 'assessment_list_id', 'id');
    }

    public function skill() {
        return $this->belongsTo(CognitiveSkillsList::class, 'name', 'title');
    }
}
