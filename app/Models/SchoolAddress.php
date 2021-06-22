<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolAddress extends Model
{
    use HasFactory;

    protected $table = 'school_address';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'address',
        'district',
        'number',
        'complement',
        'state_id',
        'city_id',
        'school_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
