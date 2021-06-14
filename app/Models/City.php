<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'cities';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'state_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'city_id', 'id');
    }
}
