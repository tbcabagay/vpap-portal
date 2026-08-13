<?php

namespace App\Http\Requests;

use App\Models\SpeciesOfSpecialization;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpeciesOfSpecializationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', SpeciesOfSpecialization::class);
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
