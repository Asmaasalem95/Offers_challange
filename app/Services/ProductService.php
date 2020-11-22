<?php


namespace App\Services;


use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * ProductService constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param $item
     * @param $currencyId
     * @return mixed
     */
    public function calculateProductPriceWithOffer($item, $currencyId)
    {
        // TODO: Implement calculateProductsPricesWithOffer() method.
        $product = $this->productRepository->getProductWithOfferAndCurrency($item, $currencyId);
        if ($product->offers[0]->pivot->discount_applicable == '1') {
            //apply the  discount on its price
            $price['original'] = $item['quantity'] * $product->prices[0]->pivot->price;
            $discount = $item['quantity'] * $product->prices[0]->pivot->price * $product->offers[0]->discount_value / 100;
            $price['final'] = $price['original'] - $discount;
            $price['discount'] = $discount;
            $price['discount_value'] = $product->offers[0]->discount_value;
        } else {
            $price['original'] = $price['final'] = $this->calculateProductPrice($item, $currencyId);
            $price['discount'] = 0;
            $price['discount_value'] = 0;
        }
        return $price;
    }

    /**
     * @param $item
     * @param $currencyId
     * @return float|int|mixed
     */
    public function calculateProductPrice($item, $currencyId)
    {

        // TODO: Implement calculateProductPrice() method.
        $product = $this->productRepository->getProductPrices($item['product_id'], $currencyId);
        return $productPrice = $item['quantity'] * $product->prices[0]->pivot->price;
    }
}
