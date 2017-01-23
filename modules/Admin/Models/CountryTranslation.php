<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
	protected $table = 'country_translations';

    public $timestamps  = false;
    protected $fillable = ['country_id','name'];
         
}