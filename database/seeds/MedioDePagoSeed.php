<?php

use Illuminate\Database\Seeder;
use App\MedioDePago;

class MedioDePagoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MedioDePago::truncate();

        $medio_de_pago_obj = new MedioDePago();
        $medio_de_pago_obj->medio_de_pago = "Efectivo";
        $medio_de_pago_obj->save();

        $medio_de_pago_obj = new MedioDePago();
        $medio_de_pago_obj->medio_de_pago = "Mercadopago";
        $medio_de_pago_obj->save();
    }
}
