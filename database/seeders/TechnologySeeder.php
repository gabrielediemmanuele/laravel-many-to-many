<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* dentro il seeder creo l'array di nomi che mi servono  */
        $tech_names = ["HTML", "CSS", "JavaScript", "SQL", "PHP", "VUE", "VITE", "BLADE", "GIT"];

        /*  con un foreach genero tanti nuove "tecnologie per quante sono dentro tec_names"  */
        foreach ($tech_names as $tech_name) {

            $technology = new Technology();

            $technology->tech_name = $tech_name;

            $technology->save();
        }
    }
}
