<?php

namespace Virta\Api\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle the failed validation Exception
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param string $prefix
     * @return array
     */
    public function rules($prefix = ''): array
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return self::appendParentToArrayKeys($this->getRules(), $prefix);
            case 'POST':
                return self::appendParentToArrayKeys($this->postRules(), $prefix);
            case 'PUT':
            case 'PATCH':
                return self::appendParentToArrayKeys($this->putRules(), $prefix);
        }
    }

    public static function appendPrefixToArrayKeys(array $array, $prefix): array
    {
        foreach ($array as $key => $value) {
            $array[$prefix . $key] = $value;
            unset($array[$key]);
        }

        return $array;
    }

    public static function appendParentToArrayKeys(array $array, $parent): array
    {
        if ($parent === '') {
            return $array;
        }
        return self::appendPrefixToArrayKeys($array, $parent . '.');
    }

    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    abstract protected function postRules(): array;

    /**
     * Get the validation rules that apply to the put/patch request.
     *
     * @return array
     */
    protected function putRules(): array
    {
        return $this->postRules();
    }

    /**
     * Get the validation rules that apply to the get request.
     *
     * @return array
     */
    protected function getRules(): array
    {
        return [];
    }
}
