<?php namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

  protected $table = 'language';
  protected $fillable = array('name', 'locale', 'icon');

}