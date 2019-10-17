<?php

namespace App\Rules\InstagramRule;

use App\Repositories\InstagramRepositories\InstagramAccountRepository;
use Illuminate\Contracts\Validation\Rule;

class InstagramAccountStatusCheck implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array(strtoupper($value), InstagramAccountRepository::STATUS_LIST, true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute acceptable values are  ' . implode(', ', InstagramAccountRepository::STATUS_LIST);
    }
}
