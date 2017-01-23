<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
  protected $fillable = ['name', 'value'];
  protected $table = 'settings';
  protected $softDelete = true;
}