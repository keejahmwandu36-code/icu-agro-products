<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tea',                'description' => 'Herbal tea products'],
            ['name' => 'Capsules',           'description' => 'Herbal capsules'],
            ['name' => 'Immunity',           'description' => 'Immune support products'],
            ['name' => 'Blood Health',       'description' => 'Blood support products'],
            ['name' => 'Digestion',          'description' => 'Digestive wellness products'],
            ['name' => 'Sugar & BP Support', 'description' => 'Blood sugar and pressure support'],
            ['name' => 'Detox & Cleansing',  'description' => 'Detox and cleansing products'],
            ['name' => 'Skin & Wellness',    'description' => 'Skin and general wellness'],
            ['name' => 'General Wellness',   'description' => 'Everyday wellness products'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name'        => $cat['name'],
                    'description' => $cat['description'],
                    'is_active'   => true,
                ]
            );
        }
    }
}