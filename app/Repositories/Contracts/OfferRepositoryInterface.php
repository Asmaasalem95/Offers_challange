<?php


namespace App\Repositories\Contracts;


interface OfferRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

}
