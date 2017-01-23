<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Country extends Model
{
  use Translatable;

  protected $table = 'country';
  public $useTranslationFallback = true;

  public $translatedAttributes = ['name'];

  protected $fillable = ['code', 'slug'];
         
}