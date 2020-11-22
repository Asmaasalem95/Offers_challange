<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $offer =  Offer::factory()->create(
            ['discount_value' => 10,
                'discount_items_number' => 1,
                'min_item' =>3,
            ]
        );
        $tshrtProduct = Product::factory()->create(['name'=>'tshirt_1']);

        $tshrtProduct->offers()->attach($offer->id,['discount_applicable' => '0']);
        $tshrtProduct->prices()->attach([[
            'currency_id' => 1,
            'price' => 100.00
        ], ['currency_id' => 2,
            'price' => 300.0
        ]]);

        $tshrtProduct = Product::factory()->create(['name'=>'tshirt_2']);
        $tshrtProduct->offers()->attach($offer->id,['discount_applicable' => '0']);
        $tshrtProduct->prices()->attach([[
            'currency_id' => 1,
            'price' => 100.00
        ], ['currency_id' => 2,
            'price' => 250.0
        ]]);

        $jacketProduct = Product::factory()->create(['name'=>'jacket']);
        $jacketProduct->offers()->attach($offer->id,['discount_applicable' => '1']);
        $jacketProduct->prices()->attach([[
            'currency_id' => 1,
            'price' => 1000.00
        ], ['currency_id' => 2,
            'price' => 500.0
        ]]);

    }
}
