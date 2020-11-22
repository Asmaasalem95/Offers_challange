<?php


namespace App\Repositories;


use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    protected $model;

    /**
     * ProductRepository constructor.
     * @param Product $productModel
     */
    public function __construct(Product $productModel)
    {
        $this->model = $productModel;
    }

    /**
     * @param $product
     * @param $currencyId
     * @return mixed
     */
    public function getProductWithOfferAndCurrency($product, $currencyId)
    {
        $offerId = $product['offer_id'];
        // TODO: Implement getProductsWithOfferAndCurrency() method.
        return $this->model->where('id', $product['product_id'])->with('offers', function ($query) use ($offerId) {
            $query->where('offer_id', $offerId);
        })->with('prices', function ($query) use ($currencyId) {
            $query->where('currency_id', '=', $currencyId);
        })->first();


    }

    /**
     * @param $productId
     * @param $currencyId
     * @return mixed
     */
    public function getProductPrices($productId, $currencyId)
    {
        // TODO: Implement getProductPrices() method.

        return $this->model->where('id', $productId)->with('prices', function ($query) use ($currencyId) {
            $query->where('currency_id', '=', $currencyId);
        })->first();
    }
}
