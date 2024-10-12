<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:50|",
            "address" => "required|max:250|",
            'email' => 'required|email|unique:users,email',
            "password" => "required|max:20|min:8|confirmed",
            'phone' => [
                'required',
                'regex:/^(0[3|5|7|8|9])+([0-9]{8})$/', // Validate số điện thoại Việt Nam
                'unique:users,phone',
            ],
            'avatar' => [
                'nullable', // Không bắt buộc (tùy chỉnh nếu muốn)
                'image',    // Phải là file ảnh
                'mimes:jpeg,png,jpg,gif',  // Các định dạng hợp lệ
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'name.max' => 'Tên người dùng không được vượt quá 50 kí tự.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.max' => 'Địa chỉ không được vượt quá 250 kí tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại Việt Nam hợp lệ.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng.',
            'avatar.image' => 'File tải lên phải là ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, hoặc gif.',
        ];
    }
}
