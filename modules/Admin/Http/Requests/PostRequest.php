<?php namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed id
 */
class PostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['post_type']       = 'required';
        $rules['post_title']      = 'required|max:255';
        $rules['slug']            = 'required';
        $rules['post_content']    = '';
        $rules['post_excerpt']    = '';
        $rules['file']      	  = 'image';
        
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}