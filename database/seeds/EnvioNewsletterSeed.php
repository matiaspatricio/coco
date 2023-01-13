<?php

use Illuminate\Database\Seeder;
use App\EnvioNewsletter;

class EnvioNewsletterSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnvioNewsletter::truncate();

        $envio_newsletter = new EnvioNewsletter();
        $envio_newsletter->asunto = "PRUEBA ENVÍO";
        $envio_newsletter->mensaje = "<p>ESTO ES <span style='background-color: #f00'></span></p>";
        $envio_newsletter->save();
    }
}
