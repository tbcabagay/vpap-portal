<?php

namespace App\Http\Requests;

use App\Models\Province;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProvinceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Province::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'region_id' => ['required', 'integer', Rule::exists('regions', 'id')],
            'name' => ['required', 'string', 'max:255', Rule::unique('provinces')],
        ];
    }
}
