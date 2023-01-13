<?php

use Illuminate\Database\Seeder;
use App\ConfirmacionUsuario;

class ConfirmacionUsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfirmacionUsuario::truncate();
    }
}
