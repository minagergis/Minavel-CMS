<?php namespace Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $table = 'posts_translations';

    public $timestamps = false;
    protected $fillable = [
        'post_id',
        'slug',
        'post_title',
        'post_excerpt',
        'post_content',
        'post_img',
        'dimensions',
        'comment_status',
        'comment_count',
    ];

}