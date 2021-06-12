<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'adresses';

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
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
