<?php

namespace App\Http\Requests;

use App\Enums\MemberType;
use App\Models\EventFee;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', EventFee::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => ['required', 'integer', Rule::exists('events', 'id')],
            'member_type_id' => ['required', Rule::enum(MemberType::class)],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
