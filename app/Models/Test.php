<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Test extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'name',
        'description',
        'test_type',
        'assessment_list_id',
        'created_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function assesmentTask() {
        return $this->belongsTo(CognifitCognitiveAssessmentList::class, 'created_by', 'id');
    }

    public function assessment () {
        return $this->belongsTo(CognifitCognitiveAssessmentList::class, 'assessment_list_id', 'id');
    }

    public function patientsTest () {
        return $this->belongsToMany(Test::class, PatientTest::class, 'test_id', 'id');
    }

    public function delete()
    {
        $this->patientsTest()->delete();
        return parent::delete();
    }
}
