<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ImportPlayersJob;
use App\Jobs\ImportTeamsJob;
use App\Jobs\ImportGamesJob;
use App\Services\BallDontLieService;

class ImportSportsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sports-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports players, teams, and games from BallDontLie API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Dispatch the jobs
        // dispatch(new ImportTeamsJob());
        // $this->info('Teams import job dispatched.');

        // dispatch(new ImportPlayersJob());
        // $this->info('Players import job dispatched.');

        dispatch(new ImportGamesJob());
        $this->info('Games import job dispatched.');

        return 0;
    }
}