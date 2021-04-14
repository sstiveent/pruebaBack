<?php

namespace Database\Seeders;

use App\Models\departamento;
use App\Models\municipio;
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
        /**
         * Insert departamentos
         */
        $departemento1 = new departamento();
        $departemento1->nombre = "Valle del cauca";
        $departemento1->save();

        $departemento2 = new departamento();
        $departemento2->nombre = "Antioquia";
        $departemento2->save();

        $departemento3 = new departamento();
        $departemento3->nombre = "Bogotá DC";
        $departemento3->save();

        /**
         * Insert municipios
         */
        $municipio = new municipio();
        $municipio->nombre = "Cali";
        $municipio->id_departamento = $departemento1->id;
        $municipio->save();

        $municipio = new municipio();
        $municipio->nombre = "Yumbo";
        $municipio->id_departamento = $departemento1->id;
        $municipio->save();

        $municipio = new municipio();
        $municipio->nombre = "Palmira";
        $municipio->id_departamento = $departemento1->id;
        $municipio->save();

        $municipio = new municipio();
        $municipio->nombre = "Medellín";
        $municipio->id_departamento = $departemento2->id;
        $municipio->save();

        $municipio = new municipio();
        $municipio->nombre = "Bogotá";
        $municipio->id_departamento = $departemento3->id;
        $municipio->save();
    }
}
