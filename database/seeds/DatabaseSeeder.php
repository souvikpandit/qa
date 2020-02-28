<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * method chaining with each() method
         * create() insert records in database
         * saveMany() creates more than one record
         * make() will genarate objects and store it to memory  
         */
        factory(App\User::class,10)->create()->each( function($user){
            $user->questions()
                ->saveMany(
                    factory(App\Question::class,rand(1,5))->make()

                )
                ->each(function($question){
                    $question->answers()->saveMany(factory(App\Answer::class,rand(1,5))->make());

                });
        } );
    }
}
