<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        'name' => 'required|string|max:255',

        'price' => 'required|numeric|min:0',

        'id_category' => 'required|exists:categories,id',

        'id_brand' => 'required|exists:brands,id',

        'status' => 'required|in:0,1',

        'sale' => 'required_if:status,1|nullable|integer|min:1|max:100',

        'company' => 'nullable|string|max:255',

        'image' => 'nullable|array|max:3',

        'image.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:1024',
        

        'detail' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
        'name.required' => 'Vui lòng nhập tên sản phẩm.',

        'price.required' => 'Vui lòng nhập giá sản phẩm.',
        'price.numeric' => 'Giá phải là số.',

        'id_category.required' => 'Vui lòng chọn category.',

        'id_brand.required' => 'Vui lòng chọn brand.',

        'status.in' => 'Trạng thái không hợp lệ.',

        'sale.required_if' => 'Vui lòng nhập phần trăm giảm giá.',
        'sale.min' => 'Sale phải từ 1% trở lên.',
        'sale.max' => 'Sale không được vượt quá 100%.',

        'image.required' => 'Vui lòng chọn ảnh.',
        'image.*.image' => 'File phải là hình ảnh.',
        'image.*.mimes' => 'Ảnh chỉ được có định dạng jpg, jpeg, png, gif hoặc webp.',
        'image.*.max' => 'Mỗi ảnh tối đa 2MB.',

        'detail.required' => 'Vui lòng nhập mô tả sản phẩm.',
    ];
    }
}


// lan dau lay ve:

// git clone link 

// dua file moi vao: 
// git add -A 

// ghi chu vao: 
// git commit -a -m "ghi chu..."

// git push origin main 