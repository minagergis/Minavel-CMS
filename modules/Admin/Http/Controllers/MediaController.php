<?php namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Modules\Admin\Http\Requests\DeleteRequest;
use Modules\Admin\Http\Requests\MediaRequest;
use Modules\Admin\Models\Media;

class MediaController extends AdminController {
    public function __construct()
    {
        parent::__construct();
    }
	public function getMedia()
	{
        $media = Media::orderBy('id', 'desc')->get();
		return view('admin::sections.media.index', compact('media'));
	}


    public function getAddMedia()
    {
        return view('admin::sections.media.create_edit');
    }

    public function postAddMedia(MediaRequest $request)
    {
        $return = $this->processForm($request);
        if ($return > 0) {
            return $return;

        } else {
            return view('admin::errors.failed');
        }
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function postDeleteMedia(DeleteRequest $request, $id) {
        if(deleteImage($request->id)) {
            return redirect()->route('admin.media.get');
        }
        return 'Failed';
    }

    protected function processForm($request , $id = null ){
        if($request->hasFile('file'))
        {
            $file           = Input::file('file');
            $filename       = $file->getClientOriginalName();
            $extension      = $file->getClientOriginalExtension();
            $size           = $file->getSize();
            $mimeType       = $file->getMimeType();
            $post_type      = 'media';
            $hash_name       = sha1($filename . time()) . '.' . $extension;

            if(strstr($mimeType, "image/")){
                $meta = $this->images($size, $post_type, $file, $hash_name);
            }else if(strstr($mimeType, "audio/")){
                return false;
            }elseif(strstr($mimeType, "video/")){
                return false;
            }else {
                return false;
            }

            $media = $id == null ? new Media : Media::find($id);
            $media->guid          = $hash_name;
            $media->type          = $post_type;
            $media->name          = $filename;
            $media->mime_type     = $mimeType;
            $media->meta          = json_encode($meta);

            if($media->save()) {
                return ['number' => $media->id, 'guid' => $media->guid];
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    
    public function getMediaData()
    {
        $media = Media::all();
        return view('admin::sections.media.index', compact('media'));
    }

    
    /**
     * @param $size
     * @param $post_type
     * @param $file
     * @param $hash_name
     * @return array
     */
    protected function images($size, $post_type, $file, $hash_name)
    {
        $meta = [
            'size' => $size,
            'dimensions' => [
                'large' => ['width' => trim(post_dimensions($post_type, 'large', 'width')), 'height' => trim(post_dimensions($post_type, 'large', 'height'))],
                'medium' => ['width' => trim(post_dimensions($post_type, 'medium', 'width')), 'height' => trim(post_dimensions($post_type, 'medium', 'height'))],
                'thumbnail' => ['width' => trim(post_dimensions($post_type, 'thumbnail', 'width')), 'height' => trim(post_dimensions($post_type, 'thumbnail', 'height'))]
            ]
        ];

        $destinationFullPath = base_path('public') . '/uploads/full/';
        $destinationLargePath = base_path('public') . '/uploads/large/';
        $destinationMediumPath = base_path('public') . '/uploads/medium/';
        $destinationThumbnailPath = base_path('public') . '/uploads/thumbnail/';

        $file->move($destinationFullPath, $hash_name);

        $imgPath = $destinationFullPath . $hash_name;

        /* Large image */
        $img1 = \Image::make($imgPath)->resize(trim(post_dimensions($post_type, 'large', 'width')), trim(post_dimensions($post_type, 'large', 'height')))->save($destinationLargePath . $hash_name);

        /* Medium image */
        $img2 = \Image::make($imgPath)->resize(trim(post_dimensions($post_type, 'medium', 'width')), trim(post_dimensions($post_type, 'medium', 'height')))->save($destinationMediumPath . $hash_name);

        /* thumb image */
        $img3 = \Image::make($imgPath)->fit(trim(post_dimensions($post_type, 'thumbnail', 'width')), trim(post_dimensions($post_type, 'thumbnail', 'height')))->save($destinationThumbnailPath . $hash_name);

        return $meta;
    }


    /**
     * Get ajax media.
     */
    public function getMediaAjaxById()
    {
        if(\Request::ajax()){
            $id = \Request::get('number');
            $media = Media::find($id);
            $media->meta = json_decode($media->meta);
            if(count($media) > 0) {
                return['success' => true, 'media' => $media];
            }
        }
        return ['success' => flase];
    }

    public function getMoreMedia()
    {
        if(\Request::ajax()){
            $lastID = intval(\Request::get('lastID'));

            if($lastID) {
                $media = Media::where('id', '<', $lastID)->orderby('id', 'DESC')->take(10)->get();
                if (count($media) > 0) {
                    $media_html = '';
                    $lastIDNew  = 0;
                    foreach ($media as $item) {
                        $media_html .= '<div class="col-md-3"><a class="thumbnail select_media" data-id="' . $item->id . '"><span href="#"><i class="fa fa-check"></i></span><img src="' . asset('public/uploads/thumbnail/' . $item->guid) . '"></a></div>';
                        $lastIDNew = $item->id;
                    }
                    
                    return ['success' => true, 'media_html' => $media_html, 'lastIDNew' => $lastIDNew];
                }
            }
        }
        return ['success' => flase];
    }
}