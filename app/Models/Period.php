<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'periods';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'description',
    ];
}
