<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Location extends Model
{
    use HasFactory;

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
