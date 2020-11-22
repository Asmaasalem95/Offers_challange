<?php


namespace App\Repositories\Contracts;


interface ProductRepositoryInterface
{
    /**
     * @param $productsId
     * @param $currencyId
     * @return mixed
     */
    public function getProductWithOfferAndCurrency($productsId,$currencyId);

    /**
     * @param $productsId
     * @param $currencyId
     * @return mixed
     */
    public function getProductPrices($productsId,$currencyId);
}
