<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
            $this->routeIs('api.resource.show') ||
            $this->routeIs('api.resource.destroy') ||
            $this->routeIs('api.resource.restore')
        ) {
            $rules = [
                'id' => 'required|integer'
            ];
        }

        if ($this->routeIs('api.resource.create_or_update')) {
            if ($this->action === 'create') {
                $rules = [
                    'action' => 'required|string|in:create',
                    'name' => 'required|string|max:200',
                    'npk' => 'required|string|max:10',
                    'email' => 'required|email|max:100',
                    'phone_number' => 'required|digits_between:7,20',
                    'section_id' => 'required|exists:mst_sections,id,deleted_at,NULL,is_active,1',
                    'role_id' => 'required|exists:mst_roles,id,deleted_at,NULL,is_active,1',
                    'type_id' => 'required|exists:mst_types,id,deleted_at,NULL,is_active,1',
                    'category_id' => 'required|exists:mst_categories,id,deleted_at,NULL,is_active,1',
                    'techstack' => 'required|array',
                    'techstack.*.id' => "required|exists:mst_techstacks,id,deleted_at,NULL,is_active,1",
                    'techstack.*.level' => 'required|integer|min:1|max:4',
                ];
            }

            if ($this->action === 'update') {
                $rules = [
                    'action' => 'required|string|in:update',
                    'id' => 'required|integer',
                    'name' => 'required|string|max:200',
                    'npk' => 'required|string|max:10',
                    'email' => 'required|email|max:100',
                    'phone_number' => 'required|numeric',
                    'section_id' => 'required|exists:mst_sections,id,deleted_at,NULL,is_active,1',
                    'role_id' => 'required|exists:mst_roles,id,deleted_at,NULL,is_active,1',
                    'type_id' => 'required|exists:mst_types,id,deleted_at,NULL,is_active,1',
                    'category_id' => 'required|exists:mst_categories,id,deleted_at,NULL,is_active,1',
                    'techstack' => 'required|array',
                    'techstack.*.id' => 'required|exists:mst_techstacks,id,deleted_at,NULL,is_active,1|unique:tbl_techstack_resources,techstack_id,NULL,id,resource_id,$this->id',
                    'techstack.*.level' => 'required|integer|min:1|max:4',
                ];
            }
        }

        return $rules;
    }
}
