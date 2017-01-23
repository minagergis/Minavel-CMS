<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
	protected $table = 'category_translations';

    public $timestamps  = false;
    protected $fillable = ['name','slug','description','author','category_id','locale'];

}