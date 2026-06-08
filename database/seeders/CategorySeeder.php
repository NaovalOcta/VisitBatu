<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Taman Hiburan',
                'slug' => 'taman-hiburan',
            ],
            [
                'name' => 'Museum',
                'slug' => 'museum',
            ],
            [
                'name' => 'Alam & Kebun',
                'slug' => 'alam-dan-kebun',
            ],
            [
                'name' => 'Kebun Binatang',
                'slug' => 'kebun-binatang',
            ],
            [
                'name' => 'Ruang Publik',
                'slug' => 'ruang-publik',
            ],
            [
                'name' => 'Kategori Testing',
                'slug' => 'kategori-testing',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
