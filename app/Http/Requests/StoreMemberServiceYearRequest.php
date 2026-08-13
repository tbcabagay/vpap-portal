<?php

namespace App\Http\Requests;

use App\Models\MemberServiceYear;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMemberServiceYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', MemberServiceYear::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'member_id' => ['required', 'integer', Rule::exists('members', 'id')],
            'year' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
            'officer_position' => ['nullable', 'string', 'max:256'],
        ];
    }
}
