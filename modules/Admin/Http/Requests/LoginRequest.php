<?php
/**
 * Created by PhpStorm.
 * User: Moaaz
 * Date: 3/21/2016
 * Time: 10:55 AM
 */

namespace Modules\Admin\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules["password"] = 'required';
        $rules['email']    = 'required|email';
        return $rules ;
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
