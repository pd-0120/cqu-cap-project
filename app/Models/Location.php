<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Location extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'name',
        'street',
        'suburb',
        'state',
        'pincode',
        'phone',
        'created_by',
        'updated_by',
     ];

	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected static function booted(): void
    {
        static::creating(function (Location $location) {
            $location->created_by = Auth::user()->id;
        });

        static::updating(function (Location $location) {
            $location->updated_by = Auth::user()->id;
        });
    }
}
