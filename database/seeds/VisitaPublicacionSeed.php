<?php

use Illuminate\Database\Seeder;
use App\VisitaPublicacion;

class VisitaPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VisitaPublicacion::truncate();
    }
}
