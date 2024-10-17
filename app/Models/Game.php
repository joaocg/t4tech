<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'home_team_id', 'visitor_team_id', 'home_team_score', 'visitor_team_score', 'game_date'];

}
