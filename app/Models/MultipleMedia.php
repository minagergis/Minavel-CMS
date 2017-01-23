<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MultipleMedia extends Model
{
  protected $table = 'multiple_media';
  protected $fillable = ['media_id','post_id'];
}