<?php

namespace App\Http\Requests;

use App\Exceptions\ThrottleException;
use App\Models\Reply;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreatePostForm extends FormRequest
{

    public function authorize()
    {
        return Gate::allows('create', new Reply());
    }

    protected function failedAuthorization()
    {
        throw new ThrottleException('Your are replying too frequently. Please take a break.');
    }

    public function rules()
    {
        return [
            'body' => 'required|spamFree',
        ];
    }
}
