<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(PaisSeed::class);
        $this->call(ProvinciaSeed::class);
        $this->call(LocalidadSeed::class);
        $this->call(CategoriaSeed::class);
        $this->call(EstadoPublicacionSeed::class);
        $this->call(EstadoUsuarioSeed::class);
        $this->call(ImagenPublicacionSeed::class);
        $this->call(ModuloSeed::class);
        $this->call(PermisoModuloSeed::class);
        $this->call(PreguntaPublicacionSeed::class);
        $this->call(PublicacionSeed::class);
        $this->call(RolSeed::class);
        $this->call(SubcategoriaSeed::class);
        $this->call(TipoDeCompraSeed::class);
        $this->call(TipoPublicacionSeed::class);
        $this->call(UsuariosSeed::class);
        $this->call(ConfirmacionUsuarioSeed::class);
        $this->call(ConfiguracionSeed::class);
        $this->call(NewsletterSeed::class);
        $this->call(SliderHomeSeed::class);
        $this->call(ReportePublicacionSeed::class);
        $this->call(FavoritoPublicacionSeed::class);
        $this->call(ColorSeed::class);
        $this->call(EnvioNewsletterSeed::class);
        $this->call(MenuFrontendSeed::class);
        $this->call(GeneroSeed::class);
        $this->call(RangoPrecioPublicacionSeed::class);
        $this->call(TipoOperacionSeed::class);
        $this->call(TipoExposicionSeed::class);
        $this->call(GarantiaSeed::class);
        $this->call(MedioDePagoSeed::class);
        $this->call(MedioDePagoPublicacionSeed::class);
        $this->call(ConfiguracionMercadoPagoSeed::class);
        $this->call(TalleSeed::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
