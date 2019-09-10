<?php

namespace App\Http\Requests\Instagram;

use App\Rules\InstagramRule\InstagramAccountStatusCheck;
use Virta\Api\Requests\BaseRequest;

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
