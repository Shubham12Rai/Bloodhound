<?php


namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StartLoginRequest extends FormRequest
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

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6', 'max:50'],
        ];
    }
    
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(
            response()->json(
                [
                    'error' => [
                        'status' => 422,
                        'message' => implode(" ",$validator->messages()->all())
                    ],
                ],
                422    
            )
        );
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'email' => Str::lower($this->email)
        ]);
    }
}
