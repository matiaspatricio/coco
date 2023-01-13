<?php

use Illuminate\Database\Seeder;
use App\ProvLocPublicacion;

class ProvLocPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProvLocPublicacion::truncate();
    }
}
