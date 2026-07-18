<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MemberRegisterRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:8|max:255'
        
        ];
    }
    public function messages()
    {
        return [
            
            'required'=>':attribute Không được để trống',
            'max'=>':attribute không được vượt quá :max ký tự',
            'email.unique'=>':attribute đã tồn tại',
            'email.email'=>':attribute sai định dạng',
            'min'=>':attribute không được nhỏ hơn :min ký tự'
            
        
        ];
    }
}
