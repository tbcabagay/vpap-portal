<?php

namespace App\Http\Requests;

use App\Models\TypeOfPractice;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTypeOfPracticeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', TypeOfPractice::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:1024'],
        ];
    }
}
