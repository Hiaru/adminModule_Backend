<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        #TODO: validate
        return true;
    }

    /**
     * GET ONLY CREDENTIALS FROM FE
     */
    public function getCredentials(){
        return $this->only('username', 'password');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    // public function rules()
    // {
    //     return [
    //         //
    //     ];
    // }
}
