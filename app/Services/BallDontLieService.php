<?php

namespace App\Services;

use App\Repositories\GameRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\TeamRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class BallDontLieService
{
    protected $baseUrl = 'https://api.balldontlie.io/v1/';
    protected $apiKey; // Property to hold the API key
    protected $playerRepository;
    protected $teamRepository;
    protected $gameRepository;
    protected $client;
    protected $maxRequestsPerMinute = 30;

    public function __construct()
    {
        // Option 1: You can set the API key from environment variables for security
        $this->apiKey = 'eabe2808-4427-4606-832d-c83bf8f1cbc3';//env('BALL_DONT_LIE_API_KEY');
        $this->playerRepository = new PlayerRepository(NULL);
        $this->teamRepository = new TeamRepository(NULL);
        $this->gameRepository = new GameRepository(NULL);
        $this->client = new Client();
    }
    
    /**
     * Perform the API request using cURL
     * @param string|null $cursor
     * @param int $perPage
     * @return array|null
     */
    public function performApiRequest($resource, $cursor = null, $perPage = 100)
    {
        // Cache key to store the response
        $cacheKey = $resource.'_cursor_' . ($cursor ?? 'start');
        return Cache::remember($cacheKey, 60 * 60, function () use ($cursor, $perPage, $resource) {
            // Initialize cURL
            $ch = curl_init();
            $url = $this->baseUrl . $resource . '?per_page=' . $perPage;
            if ($cursor) {
                $url .= '&cursor=' . $cursor;
            }

            if ($resource === 'games') {
                $url .= '&seasons[]=2023';
            }
            // Set the URL and headers
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . $this->apiKey,
                'Accept: application/json',
            ]);

            // Execute the cURL request
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                return ['data' => [], 'error' => 'cURL Error: ' . curl_error($ch)];
            }

            // Get the HTTP response code
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Close cURL session
            curl_close($ch);

            // If the response code is 200 (OK), decode and return the response
            if ($responseCode === 200) {
                $data = json_decode($response, true);
                return ($data);
            } else {
                return [
                    'data' => [],
                    'error' => 'Unexpected response code: ' . $responseCode,
                    'response' => $response,
                ];
            }
        });
    }

    /**
     * Fetch all teams with rate limiting and pagination using next_cursor
     * @return array
     */
    public function fetchAllTeams()
    {
        $teams = [];
        $cursor = null;
        $requestsMade = 0;

        do {
            // Check rate limiting, if 30 requests have been made, sleep for a minute
            if ($requestsMade >= $this->maxRequestsPerMinute) {
                sleep(60); // Sleep for 60 seconds
                $requestsMade = 0; // Reset the counter
            }

            // Fetch teams from API
            $response = $this->performApiRequest('teams', $cursor);
            
            // If response is valid, append data
            if (isset($response['data']) && (sizeof($response['data']) > 0)) {
                foreach ($response['data'] as $teamData) {
                    $this->teamRepository->updateOrCreate(
                        ['id' => $teamData['id']],
                        [
                            'name' => $teamData['name'],
                            'city' => $teamData['city'],
                            'abbreviation' => $teamData['abbreviation'],
                            'conference' => $teamData['conference'],
                            'division' => $teamData['division'],
                        ]
                    );
                }
            } else {
                Log::info('Not found data for teams.' . ($response['error'] ?? ''));
                break;
            }

            // Get the next cursor for pagination
            $cursor = $response['meta']['next_cursor'] ?? null;
            // Increment the request count
            $requestsMade++;

        } while ($cursor); // Continue if there's a next cursor

        return $teams;
    }

    /**
     * Fetch all players with rate limiting and pagination using next_cursor
     * @return array
     */
    public function fetchAllPlayers()
    {
        $players = [];
        $cursor = null;
        $requestsMade = 0;

        do {
            // Check rate limiting, if 30 requests have been made, sleep for a minute
            if ($requestsMade >= $this->maxRequestsPerMinute) {
                sleep(60); // Sleep for 60 seconds
                $requestsMade = 0; // Reset the counter
            }

            // Fetch players from API
            $response = $this->performApiRequest('players', $cursor);

            // If response is valid, append data
            if (isset($response['data']) && (sizeof($response['data']) > 0)) {
                foreach ($response['data'] as $playerData) {
                    $this->playerRepository->updateOrCreate(
                        ['id' => $playerData['id']],
                        [
                            'first_name' => $playerData['first_name'],
                            'last_name' => $playerData['last_name'],
                            'team_id' => $playerData['team']['id'] ?? null,
                            'position' => $playerData['position'],
                        ]
                    );
                }
            } else {
                Log::info('Not found data for players. '.($response['error'] ?? ''));
                break;
            }

            // Get the next cursor for pagination
            $cursor = $response['meta']['next_cursor'] ?? null;

            // Increment the request count
            $requestsMade++;

        } while ($cursor); // Continue if there's a next cursor

        return $players;
    }

     /**
     * Fetch all games with rate limiting and pagination using next_cursor
     * @return array
     */
    public function fetchAllGames()
    {
        $games = [];
        $cursor = null;
        $requestsMade = 0;

        do {
            // Check rate limiting, if 30 requests have been made, sleep for a minute
            if ($requestsMade >= $this->maxRequestsPerMinute) {
                sleep(60); // Sleep for 60 seconds
                $requestsMade = 0; // Reset the counter
            }

            // Fetch games from API
            $response = $this->performApiRequest('games', $cursor, 25);

            // If response is valid, append data
            if (isset($response['data']) && (sizeof($response['data']) > 0)) {
                foreach ($response['data'] as $gameData) {
                    $this->gameRepository->updateOrCreate(
                        ['id' => $gameData['id']],
                        [
                            'home_team_id' => $gameData['home_team']['id'],
                            'visitor_team_id' => $gameData['visitor_team']['id'],
                            'home_team_score' => $gameData['home_team_score'],
                            'visitor_team_score' => $gameData['visitor_team_score'],
                            'game_date' => $gameData['date'],
                        ]
                    );
                }
            } else {
                Log::info('Not found data for games. ' . ($response['error'] ?? ''));
                break;
            }

            // Get the next cursor for pagination
            $cursor = $response['meta']['next_cursor'] ?? null;

            // Increment the request count
            $requestsMade++;

        } while ($cursor); // Continue if there's a next cursor

        return $games;
    }

}