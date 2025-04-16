<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PatientTest extends Model
{
    use HasFactory;

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
    
    public function patient(){
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

    public function assignedBy(){
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }

    public function test(){
        return $this->belongsTo(Test::class,);
    }
}
