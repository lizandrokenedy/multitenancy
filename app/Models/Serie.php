<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'series';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'description',
    ];
}
