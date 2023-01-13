<?php

use Illuminate\Database\Seeder;
use App\ConfiguracionMercadoPago;

class ConfiguracionMercadoPagoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfiguracionMercadoPago::truncate();

        $config = new ConfiguracionMercadoPago();
        $config->CLIENT_ID = "";
		$config->CLIENT_SECRET = "";
		$config->SHORT_NAME ="";
		$config->save();
    }
}
