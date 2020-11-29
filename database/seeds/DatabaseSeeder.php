<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Setting;
use App\QuestionType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        // empty all tables 
        User::truncate();
        Setting::truncate();
        QuestionType::truncate(); 
        
        // add all data
        $this->call([
            UserSeeder::class,
            QuestionTypeSeeder::class,
            SettingSeeder::class
        ]);
    }
}
