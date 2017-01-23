<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
	protected $table = 'city_translations';

    public $timestamps  = false;
    protected $fillable = ['city_id','name'];
         
}