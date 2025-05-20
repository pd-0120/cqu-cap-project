<?php

namespace App\Models;

use App\Http\Controllers\CongnitiveFitController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'caretaker_id',
        'password',
        'email_verified_at',
        'cognifit_user_token',
        'secret_password',
        'dob'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'cognifit_user_token',
        'secret_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Automatically called after a user is created.
     */
    protected static function booted(): void
    {
        static::created(function (User $user) {
            $congnifit = new CongnitiveFitController();
            $congnifit->addUser($user);
        });
    }

    /**
     * Configure activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Optional: Get the user's first assigned role name.
     */
    public function getPrimaryRoleAttribute()
    {
        return $this->roles->pluck('name')->first();
    }

    /**
     * Relation to user details.
     */
    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * Delete user and related user details.
     */
    public function delete()
    {
        $this->userDetail()->delete();
        return parent::delete();
    }
}
