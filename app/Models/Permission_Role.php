<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission_Role extends Model
{
	protected $table = 'permission_role';
	public $timestamps = false;
	protected $fillable = ['permission_id', 'role_id'];
}