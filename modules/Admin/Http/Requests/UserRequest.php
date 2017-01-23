<?php namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['username']     = 'required|max:255|unique:users,username,' . intval($this->id);
        $rules['email']        = 'required|email|max:255|unique:users,email,' . intval($this->id);
        $rules['name']         = 'required|max:255';

        $rules['job']          = 'max:255';
        $rules['mobile']       = 'max:255';
        $rules['age']          = 'max:255';
        $rules['url']          = 'url|max:255';
        $rules['address']      = 'max:255';
        $rules['country_id']   = 'integer|max:255';
        $rules['city_id']      = 'integer|max:255';


        if(!$this->id){
            $rules['password']  = 'required|min:6';
        } else {
            $rules['password']  = 'min:6';
        }
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