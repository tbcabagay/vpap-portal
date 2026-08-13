<?php

namespace App\Http\Requests;

use App\Enums\AttendanceType;
use App\Enums\MemberDiscountType;
use App\Enums\MemberType;
use App\Enums\PaymentType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('attendance'));
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'member_id' => ['required', 'integer', Rule::exists('members', 'id')],
            'event_id' => ['required', 'integer', Rule::exists('events', 'id')],
            'sponsor_id' => ['nullable', 'integer', Rule::exists('sponsors', 'id')],
            'attendance_type_id' => ['nullable', Rule::enum(AttendanceType::class)],
            'member_discount_type_id' => ['nullable', Rule::enum(MemberDiscountType::class)],
            'member_type_id' => ['nullable', Rule::enum(MemberType::class)],
            'payment_type_id' => ['nullable', Rule::enum(PaymentType::class)],
            'membership_fee' => ['nullable', 'numeric', 'min:0'],
            'event_fee' => ['nullable', 'numeric', 'min:0'],
            'discount_fee' => ['nullable', 'numeric', 'min:0'],
            'discount_percentage' => ['nullable', 'integer', 'between:0,100'],
            'total_fees' => ['nullable', 'numeric', 'min:0'],
            'cpd_points' => ['nullable', 'numeric', 'min:0'],
            'payment_status' => ['required', Rule::in(['paid', 'unpaid', 'pending', 'refunded'])],
            'attendance_status' => ['required', Rule::in(['present', 'absent', 'excused', 'late'])],
        ];
    }
}
