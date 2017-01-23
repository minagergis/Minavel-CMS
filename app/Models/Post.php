<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

/**
 * @property mixed post_img
 */
class Post extends Model
{
  use \Conner\Tagging\Taggable;
  use Translatable;

  protected $table = 'posts';

  protected $dates = ['created_at'];

  public $useTranslationFallback = true;

  public $translatedAttributes = [
      'post_title',
      'post_excerpt',
      'post_content',
      'post_author',
      'dimensions',
      'comment_status',
      'comment_count',
  ];

  public function media()
  {
    return $this->hasOne('Modules\Admin\Models\Media', 'id', 'media_id');
  }

  public function author()
  {
    return $this->hasOne('App\Models\User', 'id', 'post_author');
  }

  public function category()
  {
    return $this->belongsToMany('App\Models\Category', 'post_category', 'post_id', 'category_id');
  }

  public function post_have_thumbnail()
  {
    return intval($this->media_id);
  }

  /* =========== Images ========== */
  public function get_full_image()
  {
    $img_path      = url('/public/uploads/full/' . $this->post_img );
    echo '<img class="img-responsive" src="'. $img_path .'">';
  }


  public function get_large_image()
  {
    $img_path      = url('/public/uploads/large/' . $this->post_img );
    echo '<img class="img-responsive" src="'. $img_path .'">';
  }

  public function get_medium_image()
  {
    $img_path      = url('/public/uploads/medium/' . $this->post_img );
    echo '<img class="img-responsive" src="'. $img_path .'">';
  }

  public function get_thumbnail_image()
  {
    $img_path      = url('/public/uploads/thumbnail/' . $this->post_img );
    echo '<img class="img-responsive" src="'. $img_path .'">';
  }

  /* =========== Images Links ========== */

  public function get_full_image_url()
  {
    $img_path = url('/public/uploads/full/' . $this->post_img );
    return $img_path;
  }

  public function get_large_image_url()
  {
    $img_path = url('/public/uploads/large/' . $this->post_img );
    return $img_path;
  }

  public function get_medium_image_url()
  {
    $img_path = url('/public/uploads/medium/' . $this->post_img );
    return $img_path;
  }

  public function get_thumbnail_image_url()
  {
    $img_path = url('/public/uploads/thumbnail/' . $this->post_img );
    return $img_path;
  }

}