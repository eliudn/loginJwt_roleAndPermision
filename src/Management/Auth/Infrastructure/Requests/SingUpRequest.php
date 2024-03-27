<?php

namespace Src\Management\Auth\Infrastructure\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Src\Management\Auth\Infrastructure\Exceptions\AuthLoginRequestException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Helper\RequestHelper;

final class SingUpRequest extends FormRequest
{
    use HttpCodesHelper, RequestHelper;
    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            'password'=>'required|min:8',
            'name'=>'required',
            'last_name'=>'nullable|string',
            'nit'=>'nullable|numeric|unique:people',
            'address'=>'nullable|string',
            'date_of_birth'=>'nullable|date',
            'email'=>'required|email|unique:emails,email',
            'phone'=>'nullable|numeric|unique:phones',
            'nick'=>'required|unique:users,username',

        ];
    }
    public function messages():array
    {
        return [
            'password.required'=>'password:is_required',
            'password.min'=>'password:min_8',
            'name.required'=>'name:is_required',
            'last_name.string'=>'last_name:is_string',
            'nit.numeric'=>'nit:is_number',
            'nit.unique'=>'nit:exist',
            'address.string'=>'address:is_string',
            'date_of_birth.date'=>':attribute:is_date',
            'email.required'=>':attribute:is_required',
            'email.email'=>':attribute:is_not_email',
            'email.unique'=>':attribute:exist',
            'phone.numeric'=>':attribute:is_not_numeric',
            'phone.unique'=>':attribute:exist',
            'nick.required'=>':attribute:is_required',
            'mick.unique'=>':attribute:exist'

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
