<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Kidney Health',
                'category' => 'General Wellness',
                'format' => 'both',
                'short_description' => 'Supports urinary tract and kidney wellness.',
                'full_description' => 'A herbal formulation traditionally used to support urinary tract and kidney health, digestive wellness, and overall vitality.',
                'ingredients' => 'Herbal blend',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
            [
                'name' => 'Custard Apple',
                'category' => 'Immunity',
                'format' => 'both',
                'short_description' => 'Immune support and overall vitality.',
                'full_description' => 'Traditionally used to support immune wellness, healthy blood sugar regulation, and general vitality.',
                'ingredients' => 'Custard apple (Annona squamosa)',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
            [
                'name' => 'Blood Boosting',
                'category' => 'Blood Health',
                'format' => 'both',
                'short_description' => 'Supports healthy blood formation.',
                'full_description' => 'A herbal blend valued for its iron and mineral content, traditionally used to support healthy blood formation and recovery.',
                'ingredients' => 'Herbal blend rich in iron and minerals',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
            [
                'name' => 'Soursop',
                'category' => 'Immunity',
                'format' => 'both',
                'short_description' => 'Immune support and general wellness.',
                'full_description' => 'Soursop (Annona muricata) traditionally used to support immune wellness, healthy blood sugar, and general vitality.',
                'ingredients' => 'Soursop (Annona muricata)',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
            [
                'name' => 'Maliana',
                'category' => 'General Wellness',
                'format' => 'both',
                'short_description' => 'Immune, digestive and liver wellness.',
                'full_description' => 'A traditional herbal blend used to support immune wellness, digestion, liver function, and general wellbeing.',
                'ingredients' => 'Herbal blend',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
            [
                'name' => 'Neem',
                'category' => 'Detox & Cleansing',
                'format' => 'both',
                'short_description' => 'Traditional cleansing and skin wellness.',
                'full_description' => 'Neem (Azadirachta indica) valued in traditional wellness practices for cleansing, skin support, and overall vitality.',
                'ingredients' => 'Neem (Azadirachta indica)',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
            [
                'name' => 'Moringa',
                'category' => 'General Wellness',
                'format' => 'both',
                'short_description' => 'Nutrient-dense daily wellness support.',
                'full_description' => 'Moringa (Moringa oleifera) is a nutrient-dense botanical traditionally used to support daily nutritional needs and general wellness.',
                'ingredients' => 'Moringa (Moringa oleifera) leaf powder',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
            [
                'name' => 'Kigelia',
                'category' => 'Skin & Wellness',
                'format' => 'both',
                'short_description' => 'Traditional African botanical wellness support.',
                'full_description' => 'Kigelia africana (Sausage Tree) valued in traditional African herbal wellness practices for its naturally occurring phytochemicals.',
                'ingredients' => 'Kigelia africana fruit',
                'directions' => 'Tea: 1 teaspoon or 1 tea bag, steep 5–10 min. Capsules: 1–2 daily after meals.',
                'price' => 120.00,
                'size' => '20 tea bags / 30 capsules',
            ],
        ];

        foreach ($products as $data) {
            $category = Category::where('name', $data['category'])->first();

            if (!$category) {
                continue;
            }

            Product::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'name'              => $data['name'],
                    'category_id'       => $category->id,
                    'format'            => $data['format'],
                    'short_description' => $data['short_description'],
                    'full_description'  => $data['full_description'],
                    'ingredients'       => $data['ingredients'],
                    'directions'        => $data['directions'],
                    'storage'           => 'Store in a cool, dry place away from direct sunlight.',
                    'price'             => $data['price'],
                    'currency'          => 'ZMW',
                    'size'              => $data['size'],
                    'stock_status'      => 'in_stock',
                    'stock_quantity'    => 100,
                    'is_active'         => true,
                ]
            );
        }
    }
}