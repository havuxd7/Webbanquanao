<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5',
            'full'=>'required|min:4',
            'phone'=>'required|min:7|unique:users,phone'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Không được để trống email',
            'email.email'=>'email không đúng định dạng',
            'email.min'=>'email không được nhỏ hơn 5 ký tự',
            'email.unique'=>'email đã tồn tại',
            'password.required'=>'Không được để trống Password',
            'password.min'=>'Password Không được nhỏ hơn 5 ký tự',
            'full.required'=>'họ tên không được để trống',
            'full.min'=>'họ tên không nhỏ hơn 4 ký tự',
            'phone.required'=>'số điện thoại không để trống',
            'phone.min'=>'số điên thoại không nhỏ hơn 7 ký tự',
            'phone.unique'=>'số điện thoại đã tòn tại',
           
        ];
    }
}
