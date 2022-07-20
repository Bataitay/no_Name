<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'name' => 'required|unique:categories|max:255',
            'phone' => 'required|unique:categories|max:11',
            'email' => 'required|email|unique:categories|max:11',
            'address' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn chưa nhập tên nhà cung cấp.',
            'unique' => 'Tên nhà cung cấp đã tồn tại.',
            'max' => 'Tên nhà cung cấp không được quá 255 từ.',
            'email' => 'Định dạng email phải là: xxxx@gmail.com',
        ];
    }
}
