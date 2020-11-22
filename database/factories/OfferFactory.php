<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'discount_value' => 10,
            'discount_items_number' => 1,
            'min_item' =>1,
            'valid_from' => date('Y-m-d'),
            'valid_to' => date("Y-m-d", strtotime("+1 week"))
        ];
    }
}
