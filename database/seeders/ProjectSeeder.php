<?php

namespace Database\Seeders;

// # CI IMPORTIAMO IL MODELLO PROJECT
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// # CI IMPORTIAMO IL MODELLO Str CHE CONTIENI METODI DI SUPPORTO PER LE STRINGHE
use Illuminate\Support\Str;

// # CI IMPORTIAMO FAKER
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $project = new Project();
            $project->name = $faker->catchPhrase();
            $project->description = $faker->text();
            $project->link = $faker->url();

            // # Str::slug() RENDE SLUG QUELLO TRA PARENTESI
            // # LO SLUG E QUALCOSA CHE PUO ANDARE NELL'URL TIPO 
            // # cerco casa rossa DIVENTERA' cerco-casa-rossa
            // # IL METODO DI Str VA IMPORTATO
            $project->slug = Str::slug($project->name);

            //! NON CI DIMENTICHIAMO DI SALVARE!
            $project->save();
        }
    }
}
