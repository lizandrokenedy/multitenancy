<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";

    protected $fillable = [
        'module_id',
        'name',
        'slug'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
