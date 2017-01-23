<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class ZoneTranslation extends Model
{
  protected $table = 'zone_translations';

  public $timestamps  = false;
  protected $fillable = ['zone_id','name'];

}