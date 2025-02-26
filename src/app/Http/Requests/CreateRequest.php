<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'last_name'    => 'required',
            'first_name'   => 'required',
            'gender'       => 'required',
            'email'        => 'required|email',
            'tel'         => 'required|max:15',
            'address'      => 'required',
            'category_id'  => 'required',
            'textarea'     => 'required|max:120',
            'building_name' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'last_name.required' => '性を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'textarea.required' => 'お問い合せ内容を入力してください',
            'textarea.max' => 'お問い合せ内容は120文字以内で入力してください',
        ];
    }
}
