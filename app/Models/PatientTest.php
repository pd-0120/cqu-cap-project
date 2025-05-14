<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PatientTest extends Model
{
    use HasFactory;
	use LogsActivity;

    protected $fillable = [
        'patient_id',
        'assigned_by',
        'test_id',
        'score',
        'status',
        'assign_for_date',
        'taken_date',
        'due_date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

    public function assignedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }

    public function test(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Test::class,);
    }

    public function patientTestResult() {
        return $this->hasOne(PatientTestResult::class);
    }

    protected static function booted (): void
    {
        static::deleting(function(PatientTest $patientTest) {
            $patientTest->patientTestResult()->delete();
        });
    }
}
