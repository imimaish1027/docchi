<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            return [];
        } else {
            return [
                'email' => 'required|string|email|max:255|unique:users',
            ];
        }
    }
}
