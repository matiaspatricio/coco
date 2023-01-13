<?php

use Illuminate\Database\Seeder;
use App\RangoPrecioPublicacion;

class RangoPrecioPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RangoPrecioPublicacion::truncate();
    }
}
