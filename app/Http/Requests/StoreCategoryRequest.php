<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'nameVi' => 'required|unique:categories| max:255',
            'nameEn' => 'required|unique:categories|max:255',
            'supplier_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn chưa nhập tên danh mục.',
            'max' => 'Tên danh mục không được quá 255 từ.',
            'unique' =>' Tên danh mục đã tồn tại',
            'supplier_id.required' => ' Nhà cung cấp không được để trống.'
        ];
    }
}
