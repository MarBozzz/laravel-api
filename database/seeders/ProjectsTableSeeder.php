<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 100; $i++){
            $new_project = new Project();
            $new_project->user_id = User::inRandomOrder()->first()->id;
            $new_project->name = $faker->word();
            $new_project->slug = Project::generateSlug($new_project->name);
            $new_project->client_name = $faker->word();
            $new_project->summary = $faker->paragraph(3);
            //$new_project->cover_image = 'https://i1.wp.com/potafiori.com/wp-content/uploads/2020/04/placeholder.png?ssl=1';
            $new_project->save();
        }
    }
}
