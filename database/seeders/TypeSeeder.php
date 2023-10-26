<?php

namespace Database\Seeders;

/* 
! add Type model connection!  
*/
use App\Models\Type;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $labels = ["Front-End", "Back-End", "Full-stack"];

        foreach ($labels as $label) {
            $type = new Type();
            $type->label = $label;

            $type->save();
        }
    }
}
