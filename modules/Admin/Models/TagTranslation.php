<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
	protected $table = 'tags_translations';

    public $timestamps  = false;
    protected $fillable = ['name','description','author','tag_id','locale'];

}