<?php

use Modules\Admin\Models\Media;

function post_dimensions($post, $type, $dim){
    $post_dimensions= [
        'post' => [
            'large'     => ['width' => 1078,    'height' => 551],
            'medium'    => ['width' => 682,     'height' => 294],
            'thumbnail' => ['width' => 100,     'height' => 51]
        ],
        'media' => [
            'large'     => ['width' => 1078,    'height' => 551],
            'medium'    => ['width' => 682,     'height' => 294],
            'thumbnail' => ['width' => 150,     'height' => 150]
        ],

    ];

    return isset($post_dimensions[$post][$type][$dim]) ? $post_dimensions[$post][$type][$dim] : $post_dimensions['post'][$type][$dim];
}

if (!function_exists('getGravatar')) {


    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param bool $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    function getGravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

}


if (!function_exists('thumbnail')) {
    /**
     * Generate Image Thumbnail
     *
     * @param $source_image_path
     * @param $thumbnail_image_path
     * @param int $thumbnail_with
     * @param int $thumbnail_height
     * @return bool
     */
    function thumbnail($source_image_path, $thumbnail_image_path, $thumbnail_with = 300, $thumbnail_height = 300)
    {
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        switch ($source_image_type) {
            case IMAGETYPE_GIF :
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG :
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;
            case IMAGETYPE_PNG :
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        if ($source_gd_image === false) {
            return false;
        }

        $source_aspect_ratio = $source_image_width / $source_image_height;
        $thumbnail_aspect_ratio = $thumbnail_with / $thumbnail_height;

        if ($source_image_width <= $thumbnail_with && $source_image_height <= $thumbnail_height) {
            $thumbnail_image_width = $source_image_width;
            $thumbnail_image_height = $source_image_height;
        } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
            $thumbnail_image_width = (int)($thumbnail_with * $source_aspect_ratio);
            $thumbnail_image_height = $thumbnail_height;
        } else {
            $thumbnail_image_width = $thumbnail_with;
            $thumbnail_image_height = (int)($thumbnail_height / $source_aspect_ratio);
        }

        $thumbnail_directory = dirname($thumbnail_image_path);
        if (!file_exists($thumbnail_directory)) {
            mkdir($thumbnail_directory);
        }


        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);

        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);

        return true;
    }
}


/**
 * Generate a unique slug.
 * If it already exists, a number suffix will be appended.
 * It probably works only with MySQL.
 *
 * @link http://chrishayes.ca/blog/code/laravel-4-generating-unique-slugs-elegantly
 *
 * @param Illuminate\Database\Eloquent\Model $model
 * @param string $value
 * @return string
 */
function getUniqueSlug(\Illuminate\Database\Eloquent\Model $model, $value)
{
    $slug = \Illuminate\Support\Str::slug($value);
    $slugCount = count($model->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' and id != '{$model->id}'")->get());

    return ($slugCount > 0) ? ( ($slugCount > 1) ? (($slugCount > 2) ? ( ($slugCount > 3) ? $slug.'-'.($slugCount+3) : $slug.'-'.($slugCount+2))  : $slug.'-'.$slugCount) ? : $slug.'-'.($slugCount+1) : $slug.'-'.$slugCount  ) : $slug;
}


if (!function_exists('settings')) {
    function settings($name)
    {
        $setting = \Modules\Admin\Models\Settings::where('name', $name)->first();

        if (isset($setting->id)) {
            return $setting->value;
        }
    }
}

function deleteImage($id){
    $image = Media::find($id);
    if ($image) {
        $sizes = ['full','large','medium','thumbnail'];
        foreach($sizes as $v){
            $images[]='public/uploads/'.$v.'/'.$image->guid;
        }
        File::delete($images);
        $image->delete();
        return true;
    }
    return false;

}


if (!function_exists('uploadFiles')) {
    function uploadFiles($files)
    {
        $files = array($files);
        $destinationFullPath = base_path('public') . '/uploads/full/';
        $destinationLargePath = base_path('public') . '/uploads/large/';
        $destinationMediumPath = base_path('public') . '/uploads/medium/';
        $destinationThumbnailPath = base_path('public') . '/uploads/thumbnail/';

        $file_count = count($files);
        $images = [];

        $uploadcount = 0;

        if($file_count > 0) {

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $img = sha1($filename . time()) . '.' . $extension;

                $upload1 = $file->move($destinationFullPath, $img);
                $imgPath = $destinationFullPath . $img;
                /* Large image */
                $upload2 = \Image::make($imgPath)->resize(1000, 500)->save($destinationLargePath . $img);

                /* Medium image */
                $upload3 = \Image::make($imgPath)->resize(600, 400)->save($destinationMediumPath . $img);

                /* thumb image */
                $upload4 = \Image::make($imgPath)->resize(150, 150)->save($destinationThumbnailPath . $img);

                if ($upload1 && $upload2 && $upload3 && $upload4) {
                    $images[] = $img;
                    $uploadcount++;
                }
            }
        }

        if($uploadcount == $file_count){
            return $images;
        }
        else {
            return [];
        }


    }
}


