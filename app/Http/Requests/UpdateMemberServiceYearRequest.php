<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMemberServiceYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('member_service_year'));
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $memberServiceYear = $this->route('member_service_year');

        return [
            'member_id' => [
                'required',
                'integer',
                Rule::exists('members', 'id'),
                Rule::unique('member_service_years', 'member_id')
                    ->where('year', $this->input('year'))
                    ->ignore($memberServiceYear->id),
            ],
            'year' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
            'officer_position' => ['nullable', 'string', 'max:256'],
        ];
    }
}
