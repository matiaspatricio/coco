<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::truncate();

        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Accesorios para Vehículos";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Alimentos y Bebidas";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Animales y Mascotas";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Antigüedades";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Arte y Artesanías";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Autos, Motos y Otros";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Bebés";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Belleza y Cuidado Personal";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Cámaras y Accesorios";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Celulares y Teléfonos";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Coleccionables y Hobbies";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Computación";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Consolas y Videojuegos";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Deportes y Fitness";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Electrodomésticos y Aires Ac.";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Electrónica, Audio y Video";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Entradas para Eventos";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Herramientas y Construcción";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Hogar, Muebles y Jardín";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Industrias y Oficinas";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Inmuebles";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Instrumentos Musicales";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Joyas y Relojes";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Juegos y Juguetes";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Libros, Revistas y Comics";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Música, Películas y Series";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Ropa y Accesorios";
        $categoria_obj->mostrar_en_menu = true;
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Salud y Equipamiento Médico";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Servicios";
        $categoria_obj->save();

        
        $categoria_obj = new Categoria();
        $categoria_obj->nombre="Otras categorías";
        $categoria_obj->save();

        
    }
}
