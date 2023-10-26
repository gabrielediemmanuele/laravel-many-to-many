<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\Technology;

use Illuminate\Support\Str;

use Faker\Generator as Faker;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all();
        $technologies = Technology::all()->pluck('id')->toArray();

        foreach ($projects as $project) {
            $project
                ->technologies()
                ->attach($faker->randomElements($technologies, random_int(0, 8)));
        }
    }
}