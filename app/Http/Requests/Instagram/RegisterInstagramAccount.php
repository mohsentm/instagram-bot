<?php

namespace App\Http\Requests\Instagram;

use App\Http\Requests\BaseFormRequest;
use App\Rules\InstagramRule\InstagramAccountStatusCheck;

class RegisterInstagramAccount extends BaseFormRequest
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
            'username' => ['required', 'string', 'max:255', 'unique:instagram_accounts'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => ['string', new InstagramAccountStatusCheck()]
        ];
    }
}
