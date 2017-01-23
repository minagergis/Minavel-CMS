<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Zone extends Model
{
  use Translatable;

  protected $table = 'zone';
  public $useTranslationFallback = true;

  public $translatedAttributes = ['name'];

  protected $fillable = ['code', 'status','city_id', 'slug'];

}