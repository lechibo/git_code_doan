<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255',
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            
        ];
    }
    public function messages(){
        
        return [
            'required'=>':attribute :Không được để trống',
            'max'=>':attribute không được quá :max kí tự',
            'min'=>'attribute không được nhỏ hơn :min',
            'email.unique'=>':attribute :email đã tồn tại',
            'email.email'=>':attribute :email sai định dạng',
            'avatar'=>':attribute file upload phải là hình ảnh',
            'mimex'=>':attribute hình ảnh upload lên phải là dạng như sau : jpeg,png,jpg,gif',
            'avatar.max'=>':attribute hình ảnh upload lên không được vượt quá :max'
        ];
    }
}
