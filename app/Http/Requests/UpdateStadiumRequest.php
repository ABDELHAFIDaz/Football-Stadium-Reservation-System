<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateStadiumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $stadium = $this->route('stadium');
        return (Auth::id() === $stadium->managerId || Auth::user()->role === 'admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|string|max:100',
            'status'            => 'required|in:available,reserved,unavailable',
            'price_per_hour'    => 'required|numeric',
            'note'              => 'nullable|string|max:500',
            'open_from'         => 'required|date_format:H:i',
            'open_until'        => 'required|date_format:H:i|after:open_from',
            'unavailable_from'  => 'required_if:status,unavailable|nullable|date',
            'unavailable_until' => 'required_if:status,unavailable|nullable|date|after_or_equal:unavailable_from',
        ];
    }
}
