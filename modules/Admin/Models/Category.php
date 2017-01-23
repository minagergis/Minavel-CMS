<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Category extends Model
{
  use Translatable;

  protected $table = 'category';
  public $useTranslationFallback = true;

  public $translatedAttributes = ['slug','name'];

  protected $fillable = ['parent', 'media_id','icon'];

  public function media()
  {
    return $this->hasOne('Modules\Admin\Models\Media', 'id', 'media_id');
  }

}