<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = "permission_role";

    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'permission_role', 'permission_id', 'id');
    // }
}
