<?php

use Illuminate\Database\Seeder;
use App\Color;

class ColorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::truncate();

        $color = new Color();
        $color->nombre = "Blanco";
        $color->color = "#fff";
        $color->save();

        $color = new Color();
        $color->nombre = "Negro";
        $color->color = "#000";
        $color->save();

        $color = new Color();
        $color->nombre = "Gris oscuro";
        $color->color = "#666";
        $color->save();

        $color = new Color();
        $color->nombre = "Gris";
        $color->color = "#e1e1e1";
        $color->save();

        $color = new Color();
        $color->nombre = "Rojo";
        $color->color = "#f00";
        $color->save();

        $color = new Color();
        $color->nombre = "Azul";
        $color->color = "#1717ff";
        $color->save();

        $color = new Color();
        $color->nombre = "Plateado";
        $color->color = "#cbcfd0";
        $color->save();

        $color = new Color();
        $color->nombre = "Azul marino";
        $color->color = "#0f5299";
        $color->save();

        $color = new Color();
        $color->nombre = "Verde";
        $color->color = "#0da600";
        $color->save();

        $color = new Color();
        $color->nombre = "Amarillo";
        $color->color = "#ffed00";
        $color->save();

        $color = new Color();
        $color->nombre = "Bordó";
        $color->color = "#830500";
        $color->save();

        $color = new Color();
        $color->nombre = "Rosa";
        $color->color = "#fcb1be";
        $color->save();

        $color = new Color();
        $color->nombre = "Rosa claro";
        $color->color = "#fadbe2";
        $color->save();

        $color = new Color();
        $color->nombre = "Celeste";
        $color->color = "#83ddff";
        $color->save();

        $color = new Color();
        $color->nombre = "Naranja";
        $color->color = "#ff8c00";
        $color->save();

        $color = new Color();
        $color->nombre = "Piel";
        $color->color = "#ffe4c4";
        $color->save();

        $color = new Color();
        $color->nombre = "Fucsia";
        $color->color = "#ff00ec";
        $color->save();

        $color = new Color();
        $color->nombre = "Marrón";
        $color->color = "#a0522d";
        $color->save();

        $color = new Color();
        $color->nombre = "Azul claro";
        $color->color = "#dcecff";
        $color->save();

        $color = new Color();
        $color->nombre = "Azul oscuro";
        $color->color = "#013267";
        $color->save();

        $color = new Color();
        $color->nombre = "Verde musgo";
        $color->color = "#3f7600";
        $color->save();

        $color = new Color();
        $color->nombre = "Violeta";
        $color->color = "#9f00ff";
        $color->save();

        $color = new Color();
        $color->nombre = "Verde claro";
        $color->color = "#9ff39f";
        $color->save();

        $color = new Color();
        $color->nombre = "Coral";
        $color->color = "#fba69c";
        $color->save();

        $color = new Color();
        $color->nombre = "Azul petróleo";
        $color->color = "#1e6e7f";
        $color->save();

        $color = new Color();
        $color->nombre = "Azul acero";
        $color->color = "#6fa8dc";
        $color->save();

        $color = new Color();
        $color->nombre = "Beige";
        $color->color = "#f5f3dc";
        $color->save();

        $color = new Color();
        $color->nombre = "Turquesa";
        $color->color = "#40e0d0";
        $color->save();

        $color = new Color();
        $color->nombre = "Crema";
        $color->color = "#ffffe0";
        $color->save();

        $color = new Color();
        $color->nombre = "Dorado";
        $color->color = "#ffd700";
        $color->save();

        $color = new Color();
        $color->nombre = "Violeta oscuro";
        $color->color = "#4e0087";
        $color->save();

        $color = new Color();
        $color->nombre = "Dorado oscuro";
        $color->color = "#bf9000";
        $color->save();

        $color = new Color();
        $color->nombre = "Agua";
        $color->color = "#e0ffff";
        $color->save();

        $color = new Color();
        $color->nombre = "Ocre";
        $color->color = "#eacb53";
        $color->save();

        $color = new Color();
        $color->nombre = "Verde oscuro";
        $color->color = "#003d00";
        $color->save();

        $color = new Color();
        $color->nombre = "Terracota";
        $color->color = "#c63633";
        $color->save();

        $color = new Color();
        $color->nombre = "Verde limón";
        $color->color = "#73e129";
        $color->save();

        $color = new Color();
        $color->nombre = "Rosa chicle";
        $color->color = "#ff51a8";
        $color->save();

        $color = new Color();
        $color->nombre = "Naranja oscuro";
        $color->color = "#d2691e";
        $color->save();

        $color = new Color();
        $color->nombre = "Rosa oscuro";
        $color->color = "#d06ea8";
        $color->save();

        $color = new Color();
        $color->nombre = "Índigo";
        $color->color = "#7a64c6";
        $color->save();
    }
}
