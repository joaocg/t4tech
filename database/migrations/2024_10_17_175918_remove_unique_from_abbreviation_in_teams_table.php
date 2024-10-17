<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueFromAbbreviationInTeamsTable extends Migration
{
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            // Remove the unique index from the abbreviation column
            $table->dropUnique(['abbreviation']);
        });
    }

    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            // Restore the unique index on the abbreviation column
            $table->unique('abbreviation');
        });
    }
}