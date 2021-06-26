<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlexibilityStatus extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'flexibility_status';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'description'
    ];
}
