<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';

    protected $fillable = ['title','desc','tags','item_id','item_type'];



}