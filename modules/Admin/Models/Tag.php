<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Tag extends Model
{
  use Translatable;

  protected $table = 'tags';
  public $useTranslationFallback = true;

  public $translatedAttributes = ['name'];

  protected $fillable = ['slug'];

}