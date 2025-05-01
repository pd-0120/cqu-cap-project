<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTestResult extends Model
{
    use HasFactory;

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
}
