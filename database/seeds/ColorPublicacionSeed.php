<?php

use Illuminate\Database\Seeder;
use App\ColorPublicacion;

class ColorPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ColorPublicacion::truncate();
    }
}
