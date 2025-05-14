<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CognitiveSkillsList extends Model
{
    use HasFactory;
	use LogsActivity;

    protected $fillable = [
        'key',
        'title',
        'description',
        'image',
        'response_data',
    ];
	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults();
	}
    public function skills() {
        return $this->hasMany(CongnifitAssessmentListSkills::class, 'assessment_list_id', 'id');
    }

    public function tasks() {
        return $this->hasMany(CognifitAssessmentListTasks::class, 'assessment_list_id', 'id');
    }
}
