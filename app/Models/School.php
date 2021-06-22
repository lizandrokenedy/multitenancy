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
    ];

    public function address()
    {
        return $this->hasOne(SchoolAddress::class, 'school_id', 'id');
    }

    public function manager()
    {
        return $this->belongsToMany(User::class, 'school_managers', 'school_id', 'manager_id');
    }
}
