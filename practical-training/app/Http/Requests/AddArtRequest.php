<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddArtRequest extends FormRequest {

    // 验证
    public function authorize() {
        return true;
    }

    // 表单验证
    public function rules() {
        return [
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required'
        ];
    }

    public function messages() {
        return [
            'title.required' => '标题不能为空！',
            'summary.required' => '摘要不能为空！',
            'content.required' => '文章内容不能为空！'
        ];
    }
}
