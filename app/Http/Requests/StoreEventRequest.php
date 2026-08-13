<?php

namespace App\Http\Requests;

use App\Enums\EventType;
use App\Enums\InvitationType;
use App\Models\Event;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Event::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_id' => ['required', Rule::enum(EventType::class)],
            'invitation_type_id' => ['required', Rule::enum(InvitationType::class)],
            'title' => ['required', 'string', 'max:65535'],
            'location' => ['required', 'string', 'max:65535'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'discount_enabled' => ['sometimes', 'boolean'],
            'membership_fee' => ['required', 'numeric', 'min:0'],
            'total_cpd_points' => ['required', 'numeric', 'min:0'],
            'maximum_participants' => ['required', 'integer', 'min:1'],
            'evaluation_link' => ['nullable', 'url', 'max:1000'],
            'invitation_link' => ['nullable', 'url', 'max:1000'],
        ];
    }
}
