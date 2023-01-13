<?php

use Illuminate\Database\Seeder;
use App\SliderHome;

class SliderHomeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SliderHome::truncate();

        $slider_home_obj = new SliderHome();
        $slider_home_obj->small_title = "Drones";
        $slider_home_obj->title = "Los mejores drones en este sitio";
        $slider_home_obj->imagen = "1.jpg";
        $slider_home_obj->link_button = url('/ingresar');
        $slider_home_obj->activo = true;
        $slider_home_obj->save();

        $slider_home_obj = new SliderHome();
        $slider_home_obj->small_title = "Iphones";
        $slider_home_obj->title = "Los mejores Iphones en este sitio";
        $slider_home_obj->imagen = "2.jpg";
        $slider_home_obj->link_button = null;
        $slider_home_obj->activo = true;
        $slider_home_obj->save();
    }
}
