<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class storeSites extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
          return true;
        }else{
          return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'operation_time' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'picture' => 'required|mimes:jpeg,jpg,png',
            'facility' => 'required',
        ];
    }
}
