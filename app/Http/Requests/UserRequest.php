<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private const GUEST_USER_ID = 1;

    public function rules()
    {
        if (Auth::id() == self::GUEST_USER_ID) {
            return [
                'age' => 'required|int|numeric',
                'pic' =>
                'file|image|max:1024|mimes:jpeg,png,jpg',
            ];
        } else {
            return [
                'name' => 'required|string|max:20',
                'age' => 'required|int|numeric',
                'pic' =>
                'file|image|max:1024|mimes:jpeg,png,jpg',
            ];
        }
    }
}
