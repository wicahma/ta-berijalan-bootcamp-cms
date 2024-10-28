<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechstackRequest extends FormRequest
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

        if (
            $this->routeIs('api.techstack.show') ||
            $this->routeIs('api.techstack.destroy') ||
            $this->routeIs('api.techstack.restore')
        ) {
            $rules = [
                'id' => 'required|integer'
            ];
        }

        if ($this->routeIs('api.techstack.create_or_update')) {
            if ($this->action === 'create') {
                $rules = [
                    'action' => 'required|string|in:create',
                    'section_id'=> 'required|exists:mst_sections,id,deleted_at,NULL,is_active,1',
                    'name'=> 'required|string|max:200',
                    'is_active'=> 'required|boolean',
                ];
            }

            if ($this->action === 'update') {
                $rules = [
                    'id' => 'required|integer',
                    'action' => 'required|string|in:update',
                    'section_id'=> 'required|exists:mst_sections,id,deleted_at,NULL,is_active,1',
                    'name'=> 'required|string|max:200',
                    'is_active'=> 'required|boolean',
                ];
            }
        }

        return $rules;
    }
}
