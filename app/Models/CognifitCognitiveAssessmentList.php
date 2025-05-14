<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CognifitCognitiveAssessmentList extends Model
{
    use HasFactory;
	use LogsActivity;

    protected $fillable = [
        'key',
        'title',
        'description',
        'image',
        'estimated_time',
        'response_data',
        'type',
    ];

	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults();
	}
    public function getTasks() {
        return $this->hasMany(CognifitAssessmentListTasks::class, 'assessment_list_id', 'id');
    }

    public function getSkills() {
        return $this->hasMany(CongnifitAssessmentListSkills::class, 'assessment_list_id', 'id');
    }
}
