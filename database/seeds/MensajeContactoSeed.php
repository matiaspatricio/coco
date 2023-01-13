<?php

use Illuminate\Database\Seeder;
use App\MensajeContacto;

class MensajeContactoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MensajeContacto::truncate();
    }
}
