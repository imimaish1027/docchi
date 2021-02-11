<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string|max:20',
            'tag' =>
            'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u|nullable',
            'answer_a' => 'required|string|max:20',
            'pic_a' =>
            'required|file|image|max:1024|mimes:jpeg,png,jpg',
            'answer_b' => 'required|string|max:20',
            'pic_b' =>
            'required|file|image|max:1024|mimes:jpeg,png,jpg',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'テーマ名',
            'tag' => 'タグ',
            'answer_a' => '選択肢Aの回答',
            'pic_a' => '選択肢Aの画像',
            'answer_b' => '選択肢Bの回答',
            'pic_b' => '選択肢Bの画像',
        ];
    }


    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 3)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}
