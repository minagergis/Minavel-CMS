<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class City extends Model
{
  use Translatable;

  protected $table = 'city';
  public $useTranslationFallback = true;

  public $translatedAttributes = ['name'];

  protected $fillable = ['slug', 'status','country_id'];
         
}