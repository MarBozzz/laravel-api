<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|min:2',
            'cover_image' => 'nullable|image|max:3200',
            'client_name' => 'required|max:100|min:2',
            'summary' => 'required|max:255|min:10',
        ];
    }

    public function messages(){
       return [
            'name.required' => 'A name is required',
            'name.max' => 'The name must have maximum :max characters',
            'name.min' => 'The name must have minimum :min characters',
            'client_name.required' => 'A client name is required',
            'client_name.max' => 'The client name must have maximum :max characters',
            'client_name.min' => 'The client name must have minimum :min characters',
            'summary.required' => 'A summary is required',
            'summary.max' => 'The summary must have maximum :max characters',
            'summary.min' => 'The summary must have minimum :min characters',
            'image.image' => 'The file image is not correct',
            'image.max' => 'The file image must be maximum :max MB'
        ];
    }
}
