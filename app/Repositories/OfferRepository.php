<?php


namespace App\Repositories;


use App\Models\Offer;
use App\Repositories\Contracts\OfferRepositoryInterface;

class OfferRepository implements OfferRepositoryInterface
{
    /**
     * @var Offer
     */
    protected $model;

    /**
     * OfferRepository constructor.
     * @param Offer $offerModel
     */
    public function __construct(Offer $offerModel)
    {
        $this->model = $offerModel;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        // TODO: Implement find() method.
        return $this->model->find($id);
    }
}
