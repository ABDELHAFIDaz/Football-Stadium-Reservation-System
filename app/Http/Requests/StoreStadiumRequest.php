<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStadiumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:100',
            'managerId'     => 'required|exists:users,id',
            'city_id'       => 'required|exists:cities,id',
            'address'       => 'required|string|max:100',
            'capacity'      => 'required|integer',
            'price_per_hour' => 'required|numeric',
            'open_from'     => 'required',
            'open_until'    => 'required',
            'equipments'    => 'required|string',
        ];
    }
}
