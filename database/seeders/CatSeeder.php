<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cat;

class CatSeeder extends Seeder
{
    public function run()
    {
        Cat::factory()->count(10)->create();
    

    Cat::create([
        'name' => 'Mimi',
        'age' => 1,
        'gender' => 'Betina',
        'breed' => 'Persia',
        'description' => 'Mimi adalah kucing ramah dan suka bermain.',
        'image' => 'cats/Mimi.jpg',
    ]);
}
}