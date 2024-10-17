<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BallDontLieService
{
    protected $baseUrl = 'https://www.balldontlie.io/api/v1/';

    public function fetchPlayers($page = 1)
    {
        return Http::get($this->baseUrl . 'players', ['page' => $page, 'per_page' => 100])->json();
    }

    public function fetchTeams()
    {
        return Http::get($this->baseUrl . 'teams')->json();
    }

    public function fetchGames($season = 2022, $page = 1)
    {
        return Http::get($this->baseUrl . 'games', ['season' => $season, 'page' => $page])->json();
    }
}
