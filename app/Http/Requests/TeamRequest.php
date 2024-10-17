<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:5|unique:teams,abbreviation',
            'conference' => 'required|string|max:255',
            'division' => 'required|string|max:255',
        ];
    }
}
