<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAnswersInQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * This file is the migration table for rename colomn name ia a table
     * So If we need to change a column name from migration,we need to create anothe migration table
     * and the command is like - "php artisan make:migration rename_answers_in_questions_table --table=questions"
     * and then we have to install doctrine/dbal via this command-" composer require doctrine/dbal"
     * Then we have to migrate,that should be rename the column
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->renameColumn('answers', 'answers_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->renameColumn('answers_count', 'answers');
        });
    }
}
