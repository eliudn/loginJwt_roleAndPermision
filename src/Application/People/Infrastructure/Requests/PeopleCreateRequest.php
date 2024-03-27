<?php

namespace Src\Application\People\Infrastructure\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Src\Application\People\Infrastructure\Exceptions\PeopleRequestFailException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Helper\RequestHelper;

final class PeopleCreateRequest extends FormRequest
{

    use HttpCodesHelper, RequestHelper;
    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'last_name'=>'nullable|string',
            'nit'=>'nullable|numeric|unique:people',
            'address'=>'nullable|string',
            'date_of_birth'=>'nullable|date',
            'email'=>'required|email|unique:emails,email',
            'phone'=>'nullable|numeric|unique:phones',
        ];
    }
    public function messages():array
    {
        return [
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
            'phone.unique'=>':attribute:exist'

        ];
    }
    public function failedValidation(Validator $validator): void
    {
        throw new PeopleRequestFailException(
            $this->formatErrorsRequest2(
                $validator->errors()->all()
            ),
            $this->badRequest(),
            true
        );
    }
}
