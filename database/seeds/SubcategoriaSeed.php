<?php

use Illuminate\Database\Seeder;
use App\Categoria;
use App\Subcategoria;

class SubcategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategoria::truncate();

        $categorias = Categoria::all();

        // DE CATEGORIA 1

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Acc. para Motos y Cuatriciclos";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Acc. y Repuestos Náuticos";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Acc. y Repuestos para Camiones";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Accesorios de Auto y Camioneta";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Audio para Vehículos";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "GNC";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Herramientas";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Limpieza de Vehículos";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Llantas y Tazas";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Navegadores GPS para Vehículos";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Neumáticos";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Repuestos Autos y Camionetas";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Repuestos de Maquinaria Pesada";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Repuestos para Motos";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Seguridad Vehicular";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Service Programado";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tuning y Performance";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 1;
        $subcategoria->save();


        // DE CATEGORIA 2

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Bebidas";
        $subcategoria->id_categoria = 2;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Comestibles";
        $subcategoria->id_categoria = 2;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Comida Preparada y Catering";
        $subcategoria->id_categoria = 2;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Frescos";
        $subcategoria->id_categoria = 2;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 2;
        $subcategoria->save();

        // DE CATEGORIA 3

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Aves";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Caballos";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Conejos";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Gatos";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Insectos";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Peces";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Perros";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Reptiles y Anfibios";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Roedores";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 3;
        $subcategoria->save();

        // DE CATEGORIA 4

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artículos Marítimos Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Audio Antiguo";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Balanzas Antiguas";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Bolsos y Valijas Antiguas";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cámaras Fotográficas Antiguas";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Carteles Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Copetinero";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cristalería Antigua";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Decoración Antigua";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Electrodomésticos Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equipos Científicos Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Filmadoras Antiguas";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Herramientas Antiguas";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Iluminación Antigua";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Indumentaria Antigua";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Instrumentos Musicales Antig.";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Joyas y Relojes Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Libros Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Llaves y Candados Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Mantequeras";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Máquinas de Escribir e Insumos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Muebles Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Navajas y Cuchillos Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

       $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Palilleros";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Perfumeros";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Platería Antigua";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Porta Servilletas";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Proyectores Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Registradoras Antiguas";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Rejas y Portones Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa de Cama Antigua";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Sifones Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Sulkys y Carros Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Teléfonos Antiguos";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Vajilla Antigua";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otras Antigüedades";
        $subcategoria->id_categoria = 4;
        $subcategoria->save();

        // DE CATEGORIA 5

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Arte";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artesanías";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Esculturas";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Insumos para Tatuajes";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Invitaciones y Tarjetas";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Souvenirs";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Vinilos";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 5;
        $subcategoria->save();

        // DE CATEGORIA 6

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Autos Chocados y Averiados";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Autos de Colección";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Autos y Camionetas";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Camiones";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Colectivos";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Maquinaria Agrícola";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Maquinaria Vial";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Motorhomes";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Motos";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Náutica";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Planes de Ahorro";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Semirremolques";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros Vehículos";
        $subcategoria->id_categoria = 6;
        $subcategoria->save();

        // DE CATEGORIA 7

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Andadores y Vehículos de Bebés";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artículos de Bebés para Baño";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artículos de Maternidad";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Chupetes y Mordillos";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Comida para Bebés";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Corralitos";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cuarto del Bebé";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Higiene y Cuidado del Bebé";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juegos y Juguetes para Bebés";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Lactancia y Alimentación";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Paseo del Bebé";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa y Calzado para Bebés";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Salud del Bebé";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Seguridad para Bebés";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 7;
        $subcategoria->save();

        // DE CATEGORIA 8

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artículos de Peluquería";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Barbería";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cuidado de la Piel";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cuidado del Cabello";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Depilación";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Electrodomésticos de Belleza";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Farmacia";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Higiene Personal";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Manicuría y Pedicuría";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Maquillaje";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Perfumes";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Splash Corporal";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tratamientos de Belleza";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 8;
        $subcategoria->save();

        // DE CATEGORIA 9

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Accesorios para Cámaras";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Álbumes y Portarretratos";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cables";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cámaras";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Drones y Accesorios";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Filmadoras y Cámaras de Acción";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Instrumentos Ópticos";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Lentes y Filtros";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Repuestos para Cámaras";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Revelado y Laboratorio";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 9;
        $subcategoria->save();

        // DE CATEGORIA 10

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Accesorios para Celulares";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Celulares y Smartphones";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Handies y Radiofrecuencia";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Lentes de Realidad Virtual";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Repuestos de Celulares";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Smartwatches y Accesorios";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tarifadores y Cabinas";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Telefonía Fija e Inalámbrica";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Telefonía IP";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 10;
        $subcategoria->save();

        // DE CATEGORIA 11
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cigarrillos y Afines";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Colecciones Diversas";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Figuritas, Álbumes y Cromos";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Filatelia";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Lapiceras, Plumas y Tinteros";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Latas, Botellas y Afines";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Militaría y Afines";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Modelismo";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Monedas y Billetes";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Posters, Carteles y Fotos";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tarjetas Coleccionables";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();


        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 11;
        $subcategoria->save();

        // DE CATEGORIA 12

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Accesorios de Antiestática";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Almacenamiento";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Apple";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cables y Hubs USB";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cajas, Sobres y Porta CDs";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Componentes de PC";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Conectividad y Redes";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Estabilizadores y UPS";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Impresión";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Laptops y Accesorios";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Lectores y Scanners";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Limpieza y Cuidado de PCs";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Monitores y Accesorios";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Mouses, Teclados y Controles";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Palms y Handhelds";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "PC de Escritorio";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Proyectores y Pantallas";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Software";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tablets y Accesorios";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Webcams y Audio para PC";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 12;
        $subcategoria->save();

        // DE CATEGORIA 13

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Figuras Interactivas";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Flippers y Arcade";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Nintendo";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "PlayStation";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "SEGA";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tarjetas Prepagas para Juegos";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Videojuegos";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Xbox";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otras Marcas";
        $subcategoria->id_categoria = 13;
        $subcategoria->save();


        // DE CATEGORIA 14

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Aerobics y Fitness";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artes Marciales y Boxeo";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Bádminton";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Básquet";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Bicicletas y Ciclismo";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Camping";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Deportes Acuáticos";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Deportes Extremos";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equitación y Polo";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Esgrima";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Fútbol";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Fútbol Americano";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Golf";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Handball";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Hockey";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juegos de Salón";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Libros y Revistas de Deportes";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Monopatines y Scooters";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Montañismo y Trekking";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Natación";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Patín, Gimnasia y Danza";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pesca";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pilates y Yoga";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pulsómetros y Cronómetros";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa Deportiva";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Rugby";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ski y Snowboard";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Softball y Beisbol";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Suplementos Deportivos";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tenis, Padel y Squash";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Voley";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Zapatillas";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 14;
        $subcategoria->save();


        // DE CATEGORIA 15

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artefactos de Cuidado Personal";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artefactos para el Hogar";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Climatización";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cocción";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Dispensadores y Purificadores";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Electrodomésticos de Cocina";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Heladeras y Freezers";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Lavarropas y Secarropas";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Termotanques y Calefones";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 15;
        $subcategoria->save();


        // DE CATEGORIA 16

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Accesorios para Audio y Video";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Accesorios para TV";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Audio";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cables";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Componentes Electrónicos";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Controles Remotos";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Drones y Accesorios";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Fundas y Bolsos";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Media Streaming";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pilas y Cargadores";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Proyectores y Pantallas";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Repuestos para TV";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "TVs";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Video";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 16;
        $subcategoria->save();


        // DE CATEGORIA 17
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Entradas para Eventos";
        $subcategoria->id_categoria = 17;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Entradas de Colección";
        $subcategoria->id_categoria = 17;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Eventos Deportivos";
        $subcategoria->id_categoria = 17;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Exposiciones";
        $subcategoria->id_categoria = 17;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Recitales";
        $subcategoria->id_categoria = 17;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Teatro";
        $subcategoria->id_categoria = 17;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otras Entradas";
        $subcategoria->id_categoria = 17;
        $subcategoria->save();


        // DE CATEGORIA 18

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Aberturas";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Baños y Sanitarios";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Construcción";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Electricidad";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Herramientas";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Mobiliario para Cocinas";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Paneles Solares";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pinturería";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pisos y Revestimientos";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Plomería";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 18;
        $subcategoria->save();


        // DE CATEGORIA 19

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Adornos y Decoración del Hogar";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Baños";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Bazar y Cocina";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Colchones y Sommiers";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cortinas y Accesorios";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cuidado del Hogar y Lavandería";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Iluminación para el Hogar";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Jardines y Exteriores";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Muebles para el Hogar";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Organización para el Hogar";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Seguridad para el Hogar";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Textiles de Hogar y Decoración";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 19;
        $subcategoria->save();


        // DE CATEGORIA 20

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Arquitectura y Diseño";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Embalajes";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equipamiento Comercial";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equipamiento para Industrias";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equipamiento para Oficinas";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Industria Agropecuaria";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Industria Gastronómica";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Industria Gráfica e Impresión";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Industria Textil";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Librería";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Material de Promoción";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Seguridad Industrial";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Uniformes";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();
        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 20;
        $subcategoria->save();

        // DE CATEGORIA 21

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Camas Náuticas";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Campos";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Casas";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cocheras";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Consultorios";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Departamentos";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Depósitos y Galpones";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Fondo de Comercio";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Locales";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Oficinas";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Parcelas, Nichos y Bóvedas";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "PH";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Quintas";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Terrenos y Lotes";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tiempo Compartido";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros Inmuebles";
        $subcategoria->id_categoria = 21;
        $subcategoria->save();

        // DE CATEGORIA 22

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Baterías y Percusión";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equipos de DJ y Accesorios";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Estudio de Grabación";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Instrumentos de Cuerdas";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Instrumentos de Viento";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Metrónomos";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Micrófonos y Amplificadores";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Parlantes y Bafles";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Partituras y Letras";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pedales y Accesorios";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Teclados y Pianos";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 22;
        $subcategoria->save();

        // DE CATEGORIA 23

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Exhibidores y Joyeros";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Insumos para Joyería";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Joyas y Bijouterie";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Piedras Preciosas";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Plumas y Lapiceras de Lujo";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pulsómetros y Cronómetros";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Relojes";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Repuestos para Relojes";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Smartwatch";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 23;
        $subcategoria->save();

        // DE CATEGORIA 24

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Armas y Lanzadores de Juguete";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Bloques y Construcción";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Casas y Carpas para Niños";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Dibujo, Pintura y Manualidades";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Disfraces y Cotillón";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Electrónicos para Niños";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Hobbies";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Instrumentos Musicales";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juegos de Agua y Playa";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juegos de Mesa y Cartas";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juegos de Plaza y Aire Libre";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juegos de Salón";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juguetes Antiestrés e Ingenio";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juguetes de Bromas";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juguetes de Oficios";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Juguetes para Bebés";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Mesas y Sillas para Niños";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Muñecos y Muñecas";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Patines y Patinetas";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pelotas y Animales Saltarines";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Peloteros y Castillos";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Peluches";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Títeres y Marionetas";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Vehículos de Juguete";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Vehículos Montables para Niños";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 24;
        $subcategoria->save();

        // DE CATEGORIA 25

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Catálogos";
        $subcategoria->id_categoria = 25;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Comics e Historietas";
        $subcategoria->id_categoria = 25;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Libros";
        $subcategoria->id_categoria = 25;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Manga";
        $subcategoria->id_categoria = 25;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Revistas";
        $subcategoria->id_categoria = 25;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 25;
        $subcategoria->save();

        // DE CATEGORIA 26

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Música";
        $subcategoria->id_categoria = 26;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Películas";
        $subcategoria->id_categoria = 26;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Series de TV";
        $subcategoria->id_categoria = 26;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 26;
        $subcategoria->save();

        // DE CATEGORIA 27

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Accesorios de Moda";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Anteojos";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Bermudas y Shorts";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Blusas";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Buzos y Hoodies";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Calzas";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Camisas";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Camperas, Tapados y Trenchs";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Chombas";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Enteritos";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equipaje, Bolsos y Carteras";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Lotes de Ropa";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pantalones, Jeans y Joggings";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Polleras";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Remeras y Musculosas";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa de Danza";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa Deportiva";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa Interior y de Dormir";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa y Calzado para Bebés";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Saquitos, Sweaters y Chalecos";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Trajes";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Trajes de Baño";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Uniformes";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Vestidos";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Zapatillas";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Zapatos";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 27;
        $subcategoria->save();

        // DE CATEGORIA 28

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cuidado de la Salud";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Equipamiento Médico";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Masajes";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Movilidad";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ortopedia";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Suplementos Alimenticios";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Terapias Alternativas";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 28;
        $subcategoria->save();

        // DE CATEGORIA 29

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Asesoramiento Contable y Legal";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Belleza y Cuidado Personal";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Comunicación y diseño";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cursos y Clases";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Delivery";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Fiestas y Eventos";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Fotografía, Música y Cine";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Hogar y Construcción";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Imprenta";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Mantenimiento de Vehículos";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Medicina y Salud";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Ropa y Moda";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Servicios para Mascotas";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Servicios para Oficinas";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Tecnología";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Transporte";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Viajes y Turismo";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros Servicios";
        $subcategoria->id_categoria = 29;
        $subcategoria->save();

        // DE CATEGORIA 30

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Adultos";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Artículos de Mercería";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Cigarros y Pipas";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Coberturas Extendidas";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Criptomonedas";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Esoterismo";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Gift Cards";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Kits de Criminalística";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Licencias para Taxis";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Mangas de Viento";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Pirotecnia";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Prueba Shipping";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        
        $subcategoria = new Subcategoria();
        $subcategoria->nombre = "Otros";
        $subcategoria->id_categoria = 30;
        $subcategoria->save();

        






        

        



        






        








        



        


























        


        


    }
}
