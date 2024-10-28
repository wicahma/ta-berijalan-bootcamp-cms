<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];

        if (
            $this->routeIs('api.section.destroy') ||
            $this->routeIs('api.section.restore')
        ) {
            $rules = [
                'id' => 'required|integer'
            ];
        }

        if ($this->routeIs('api.section.create_or_update')) {
            if ($this->action === 'create') {
                $rules = [
                    'action' => 'required|string|in:create',
                    'name' => 'required|string|max:200',
                    'is_active' => 'required|boolean',
                ];
            }

            if ($this->action === 'update') {
                $rules = [
                    'id' => 'required|integer',
                    'action' => 'required|string|in:update',
                    'name' => 'required|string|max:200',
                    'is_active' => 'required|boolean',
                ];
            }
        }

        return $rules;
    }
}
