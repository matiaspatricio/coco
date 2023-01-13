<?php

use Illuminate\Database\Seeder;
use App\Newsletter;

class NewsletterSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Newsletter::truncate();

        
    }
}