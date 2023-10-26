<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all()->pluck("id")->toArray();
        /* $types[] = null; */

        for ($i = 0; $i < 10; $i++) {
            $type_id = $faker->randomElement($types);

            $project = new Project();

            $project->author = $faker->firstNameMale();
            $project->title = $faker->catchPhrase();
            $project->slug = Str::slug($project->title);
            $project->link = $faker->catchPhrase();
            $project->date = $faker->dateTime();

            $project->type_id = $type_id;

            $project->description = $faker->paragraphs(1, true);

            $project->save();
        }
    }
}
