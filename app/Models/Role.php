<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    public $timestamps = true;
    protected $fillable = array('name');

	public function admins()
    {
		return $this->hasMany(Admin::class, 'role_id');
	}

	public function permissions()
    {
		return $this->belongsToMany(Permission::class, 'role_permissions');
	}

    public function permissionHas($permission)
    {
        return self::permissions()->where('permission_id', $permission)->exists();
    }
}
