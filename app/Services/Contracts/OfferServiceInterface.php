<?php


namespace App\Services\Contracts;


interface OfferServiceInterface
{
    /**
     * @param $offerId
     * @param $items
     * @return mixed
     */
    public function checkOfferEligibility($offerId,$items);

}
