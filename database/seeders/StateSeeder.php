<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            # Mexico States
            ['name' => 'Aguascalientes', 'code' => 'Ags.', 'country_id' => 2],
            ['name' => 'Baja California', 'code' => 'BC', 'country_id' => 2],
            ['name' => 'Baja California Sur', 'code' => 'BCS', 'country_id' => 2],
            ['name' => 'Campeche', 'code' => 'Camp.', 'country_id' => 2],
            ['name' => 'Coahuila de Zaragoza', 'code' => 'Coah.', 'country_id' => 2],
            ['name' => 'Colima', 'code' => 'Col.', 'country_id' => 2],
            ['name' => 'Chiapas', 'code' => 'Chis.', 'country_id' => 2],
            ['name' => 'Chihuahua', 'code' => 'Chih.', 'country_id' => 2],
            ['name' => 'Distrito Federal', 'code' => 'DF', 'country_id' => 2],
            ['name' => 'Durango', 'code' => 'Dgo.', 'country_id' => 2],
            ['name' => 'Guanajuato', 'code' => 'Gto.', 'country_id' => 2],
            ['name' => 'Guerrero', 'code' => 'Gro.', 'country_id' => 2],
            ['name' => 'Hidalgo', 'code' => 'Hgo.', 'country_id' => 2],
            ['name' => 'Jalisco', 'code' => 'Jal.', 'country_id' => 2],
            ['name' => 'Ciudad de México', 'code' => 'Mex.', 'country_id' => 2],
            ['name' => 'Michoacan de Ocampo', 'code' => 'Mich.', 'country_id' => 2],
            ['name' => 'Morelos', 'code' => 'Mor.', 'country_id' => 2],
            ['name' => 'Nayarit', 'code' => 'Nay.', 'country_id' => 2],
            ['name' => 'Nuevo Leon', 'code' => 'NL', 'country_id' => 2],
            ['name' => 'Oaxaca', 'code' => 'Oax.', 'country_id' => 2],
            ['name' => 'Puebla', 'code' => 'Pue.', 'country_id' => 2],
            ['name' => 'Queretaro', 'code' => 'Qro.', 'country_id' => 2],
            ['name' => 'Quintana Roo', 'code' => 'Q. Roo', 'country_id' => 2],
            ['name' => 'San Luis Potosi', 'code' => 'SLP', 'country_id' => 2],
            ['name' => 'Sinaloa', 'code' => 'Sin.', 'country_id' => 2],
            ['name' => 'Sonora', 'code' => 'Son.', 'country_id' => 2],
            ['name' => 'Tabasco', 'code' => 'Tab.', 'country_id' => 2],
            ['name' => 'Tamaulipas', 'code' => 'Tamps.', 'country_id' => 2],
            ['name' => 'Tlaxcala', 'code' => 'Tlax.', 'country_id' => 2],
            ['name' => 'Veracruz de Ignacio de la Llave', 'code' => 'Ver.', 'country_id' => 2],
            ['name' => 'Yucatan', 'code' => 'Yuc.', 'country_id' => 2],
            ['name' => 'Zacatecas', 'code' => 'Zac.', 'country_id' => 2],

        ];

        \App\Models\State::insert($states);
    }
}
