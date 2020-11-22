<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer = Offer::factory()->create()->each(function ($offer) {
            $product = Product::factory()->create();
            //create pivot table
            $product->offers()->attach($offer->id, ['discount_applicable' => '1']);
            $product->prices()->attach([[
                'currency_id' => 1,
                'price' => 100.00
            ], ['currency_id' => 2,
                'price' => 500.0
            ]]);
        });

    }
}
