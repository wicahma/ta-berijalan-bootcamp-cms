<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];

        if ($this->routeIs('auth.login')) {
            $rules = [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8'
            ];
        }

        if ($this->routeIs('auth.register')) {
            $rules = [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'name' => 'required|string|max:200'
            ];
        }

        return $rules;
    }
}
