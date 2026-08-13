<?php

namespace App\Http\Requests;

use App\Models\Address;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Address::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'member_id' => ['required', 'integer', Rule::exists('members', 'id')],
            'type' => ['required', 'string', Rule::in(Address::TYPES)],
            'address' => ['nullable', 'string'],
            'subdivision' => ['nullable', 'string'],
            'barangay' => ['nullable', 'string'],
            'municipality_id' => ['nullable', 'integer', Rule::exists('municipalities', 'id')],
            'province_id' => ['nullable', 'integer', Rule::exists('provinces', 'id')],
            'region_id' => ['nullable', 'integer', Rule::exists('regions', 'id')],
            'country_id' => ['nullable', 'integer', Rule::exists('countries', 'id')],
            'zip_code' => ['nullable', 'string', 'max:64'],
            'phone_number' => ['nullable', 'string', 'max:64'],
            'mobile_number' => ['nullable', 'string', 'max:64'],
        ];
    }
}
