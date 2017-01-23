<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class WebInfo extends Model
{
    protected $table = 'web_info';

    protected $fillable = ['title', 'desc', 'tags', 'socials', 'extras', 'stats', 'locale'];


}