<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'telephone',
    ];

    public function address()
    {
        return $this->hasOne(SchoolAddress::class, 'school_id', 'id');
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'school_managers', 'school_id', 'manager_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'school_teacher', 'school_id', 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'school_student', 'school_id', 'student_id');
    }
}
