<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class UserDetail extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'user_id' ,
        'street',
        'suburb',
        'state',
        'phone',
        'gender',
        'emergency_contact',
        'emergency_phone',
        'medical_history',
        'cognitive_score',
        'last_exercise_date',
        'status',
        'location_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function Location() {
        return $this->belongsTo(Location::class);
    }
}
