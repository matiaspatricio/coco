<?php

use Illuminate\Database\Seeder;
use App\MedioDePagoPublicacion;

class MedioDePagoPublicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MedioDePagoPublicacion::truncate();
    }
}
