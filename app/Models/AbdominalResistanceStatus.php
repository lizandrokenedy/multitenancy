<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbdominalResistanceStatus extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'abdominal_resistance_status';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'description'
    ];
}
