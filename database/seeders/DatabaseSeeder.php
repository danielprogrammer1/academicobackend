<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use App\Models\Curso;

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
        Estudiante::factory()->times(15)->create();
        Curso::factory()->times(8)->create()->each(function($curso){
            $curso->estudiantes()->sync(
                Estudiante::all()->random(3)
            );
        });
    }
}
