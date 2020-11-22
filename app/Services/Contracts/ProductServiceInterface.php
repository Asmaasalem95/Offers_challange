<?php


namespace App\Services\Contracts;


interface ProductServiceInterface
{

    /**
     * @param $product
     * @param $currencyId
     * @return mixed
     */
    public function calculateProductPriceWithOffer($product,$currencyId);

    /**
     * @param $product
     * @param $currencyId
     * @return mixed
     */
    public function calculateProductPrice($product,$currencyId);

}
