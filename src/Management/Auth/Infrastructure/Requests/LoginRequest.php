<?php

namespace Src\Management\Auth\Infrastructure\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Src\Management\Auth\Infrastructure\Exceptions\AuthLoginRequestException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Helper\RequestHelper;

final class LoginRequest extends FormRequest
{
    use HttpCodesHelper, RequestHelper;
    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required',
            'password'=>'required|min:8'
        ];
    }
    public function messages():array
    {
        return [
            'email.required'=>'email:is_required',
            // 'email.email'=>'email:is_not_email',
            'password.required'=>'password:is_required',
            'password.min'=>'password:min_8'
        ];
    }
    public function failedValidation(Validator $validator): void
    {
        throw new AuthLoginRequestException(
            $this->formatErrorsRequest2(
                $validator->errors()->all()
            ),
            $this->badRequest(),
            true
        );
    }
}
