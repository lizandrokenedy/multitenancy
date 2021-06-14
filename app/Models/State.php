<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'states';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'uf',
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'state_id', 'id');
    }
}
