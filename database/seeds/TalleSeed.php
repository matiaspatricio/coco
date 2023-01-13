<?php

use Illuminate\Database\Seeder;
use App\Talle;

class TalleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Talle::truncate();

        for($i=1; $i<= 45;$i++)
        {
            $talle_obj = new Talle();
            $talle_obj->talle = $i;
            $talle_obj->save();
        }
    }
}
