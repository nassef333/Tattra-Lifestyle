<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['max:255'],
            'story_img' => ['required_without:video', 'max:4096'],
            'video' => ['required_without:img'],
            'post_id' => ['required'],
            'pub_number' => ['max:255'],
            'slot_number' => ['max:255'],
            'ads_script' => ['max:255'],
        ];
    }
}
