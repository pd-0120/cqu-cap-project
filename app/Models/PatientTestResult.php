<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PatientTestResult extends Model
{
    use HasFactory;
	use LogsActivity;
    public $fillable = [
        'patient_test_id',
        'date',
        'type_key',
        'type',
        'cognitive_age',
        'cognitive_precision',
        'score',
        'response'
    ];

    public function PatientTest() {
        return $this->belongsTo(PatientTest::class);
    }

	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults();
	}
}
