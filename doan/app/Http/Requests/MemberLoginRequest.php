<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
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
            'email'=>'required|email|max:255',
            'password'=>'required|string|min:8'
        ];
    }
    public function messages(){
        return [
            'required'=>':attribute không được để trống',
            'email.unique'=>':attribute đã tồn tại',
            'email.email'=>':attribute sai định dạng',
            'max'=>':attribute không được vượt quá :max ký tự',
            'min'=>':attribute không được nhỏ hơn :min ký tự'
        ];
    }
    public function attributes(){
        return [
            'email'=>'Email',
            'password'=>'Mật khẩu'
        ];

    }
}
