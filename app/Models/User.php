<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'cell',
        'telephone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id', 'id');
    }

    public function hasPermissions($permission): bool
    {
        $user = $this->roles()->with('permissions')->first();
        return $user->permissions->contains('slug', $permission);
    }

    public function managers()
    {
        return $this->belongsToMany(School::class, 'school_managers', 'manager_id', 'school_id');
    }

    public function teachersSchool()
    {
        return $this->belongsToMany(School::class, 'school_teacher', 'teacher_id', 'school_id');
    }

    public function studentsSchool()
    {
        return $this->belongsToMany(School::class, 'school_student', 'student_id', 'school_id');
    }
}
