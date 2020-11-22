<?php


namespace App\Services;


use App\Repositories\Contracts\OfferRepositoryInterface;
use App\Services\Contracts\OfferServiceInterface;

class OfferService implements OfferServiceInterface
{
    /**
     * @var OfferRepositoryInterface
     */
    protected $offerRepository;

    /**
     * OfferService constructor.
     * @param OfferRepositoryInterface $offerRepository
     */
    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param $offerId
     * @param $items
     * @return bool|mixed
     */
    public function checkOfferEligibility($offerId, $items)
    {
        // TODO: Implement checkOfferEligibility() method.

        $offer = $this->offerRepository->find($offerId);

        $totalQuantity = $items->pluck('quantity')->sum();

        if ($offer) {
            //TODO::check validation date
            if ($offer->min_item <= $totalQuantity) {

                return $offer;

            } else return false;

        }


    }


}
