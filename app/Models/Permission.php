<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $guarded = [];

    public function permissionChildren(){
        return $this->hasMany(Permission::class, 'parent_id');
    }

    public function permissionParent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }
}
