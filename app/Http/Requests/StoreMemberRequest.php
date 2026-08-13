<?php

namespace App\Http\Requests;

use App\Enums\MemberDiscountType;
use App\Enums\MemberType;
use App\Models\Member;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Member::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'first_name' => ['required', 'string', 'max:64'],
            'middle_name' => ['nullable', 'string', 'max:64'],
            'last_name' => ['required', 'string', 'max:64'],
            'suffix' => ['nullable', 'string', 'max:4'],
            'certificate_complete_name' => ['nullable', 'string', 'max:150'],
            'nickname' => ['nullable', 'string', 'max:32'],
            'birth_date' => ['nullable', 'date'],
            'institution_id' => ['nullable', 'integer', Rule::exists('institutions', 'id')],
            'graduated_at' => ['nullable', 'string', 'size:4', 'regex:/^\d{4}$/'],
            'is_employed' => ['sometimes', 'boolean'],
            'company_name' => ['nullable', 'string'],
            'position' => ['nullable', 'string', 'max:256'],
            'member_type_id' => ['nullable', Rule::enum(MemberType::class)],
            'member_discount_type_id' => ['nullable', Rule::enum(MemberDiscountType::class)],
            'joined_at' => ['nullable', 'string', 'size:4', 'regex:/^\d{4}$/'],
            'license_number' => ['nullable', 'string', 'max:10', Rule::unique('members', 'license_number')],
            'license_expiry_date' => ['nullable', 'date'],
            'was_president' => ['sometimes', 'boolean'],
            'species_of_specializations' => ['sometimes', 'array'],
            'species_of_specializations.*' => ['integer', Rule::exists('species_of_specializations', 'id')],
            'type_of_practices' => ['sometimes', 'array'],
            'type_of_practices.*' => ['integer', Rule::exists('type_of_practices', 'id')],
        ];
    }
}
