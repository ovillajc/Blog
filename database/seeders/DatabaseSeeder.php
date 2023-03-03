<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Creamos la carpeta post para que el factory image no de problemas
        Storage::deleteDirectory('public/posts');
        Storage::makeDirectory('public/posts');

        // Seeder de permisos para los roles
        $this->call(RoleSeeder::class);

        // LLamamos los seeder para ejecutarlos todos a la vez
        $this->call(UserSeeder::class);
        Category::factory(4)->create();
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);
    }
}
