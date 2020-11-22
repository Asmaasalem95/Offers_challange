<?php

namespace Tests\Unit;

use App\Http\Controllers\Apis\InvoiceController;
use App\Services\Contracts\OfferServiceInterface;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    private  $invoiceController;
    private  $offerService;

    public function __construct(OfferServiceInterface $offerService)
    {
      $this->offerService = $offerService;
    }




}
