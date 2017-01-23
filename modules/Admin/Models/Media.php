<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  protected $table = 'media';
  protected $fillable = ['guid','type','mime_type', 'media_id'];
}