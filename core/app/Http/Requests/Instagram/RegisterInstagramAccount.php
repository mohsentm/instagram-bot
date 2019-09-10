<?php

namespace App\Http\Requests\Instagram;

use App\Http\Requests\BaseRequest;
use App\Rules\InstagramRule\InstagramAccountStatusCheck;

class RegisterInstagramAccount extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function postRules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:instagram_accounts'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => ['string', new InstagramAccountStatusCheck()]
        ];
    }
}
