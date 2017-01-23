<?php namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;

class SettingsRequest extends FormRequest
{

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $rules = [];

    foreach(Config::get('settings.attributes') as $attr)
    {
      $rules[$attr['slug']] = $attr['rules'];
    }

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