<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $table = 'assessments';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'body_mass',
        'height',
        'flexibility',
        'abdominal_resistance',
        'student_id',
        'evaluator_id',
        'school_id',
        'imc',
    ];

    public function students()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id', 'id');
    }

    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

}
