<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'home_team_id' => 'required|exists:teams,id',
            'visitor_team_id' => 'required|exists:teams,id',
            'home_team_score' => 'nullable|integer',
            'visitor_team_score' => 'nullable|integer',
            'game_date' => 'required|date',
        ];
    }
}
