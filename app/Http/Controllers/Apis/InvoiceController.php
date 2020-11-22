<?php

namespace App\Http\Controllers\Apis;

use App\Services\Contracts\InvoiceServiceInterface;
use App\Services\Contracts\OfferServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class InvoiceController extends Controller
{

    /**
     * @var ProductServiceInterface
     */
    protected $productService;
    /**
     * @var OfferServiceInterface
     */
    protected $offerService;
    /**
     * @var InvoiceServiceInterface
     */
    protected $invoiceService;

    /**
     * InvoiceController constructor.
     * @param ProductServiceInterface $productService
     * @param OfferServiceInterface $offerService
     * @param InvoiceServiceInterface $invoiceService
     */
    public function __construct(ProductServiceInterface $productService,
                                OfferServiceInterface $offerService,
                                InvoiceServiceInterface $invoiceService
    )
    {
        $this->productService = $productService;
        $this->offerService = $offerService;
        $this->invoiceService = $invoiceService;
    }

    public function index(Request $request)
    {

        $invoice_items = [];
        $offersItems = [];
        //check on every product if has offer
        foreach ($request->products as $item) {
            //split products offers array
            if (isset($item['offer_id'])) {
                array_push($offersItems, $item);
            }
            // products which has no offer
            else {
                $price = $this->productService->calculateProductPrice($item, $request->currency_id);
                array_push($invoice_items, [
                    'product_id' => $item['product_id'],
                    'quantity'=> $item['quantity'],
                    'discount'=> 0,
                    'discount_value' =>0,
                    'currency_id' => $request->currency_id,
                    'cost' => $price,
                    'original_price'=>$price
                ]);

            }
        }
        //products with offers
        $collection = $this->groupingOffersItems($offersItems);
        foreach ($collection as $offerItems) {
            $offer = $this->offerService->checkOfferEligibility($offerItems[0]['offer_id'], $offerItems);
            if ($offer) {
                //calculate product costs
                foreach ($offerItems as $item) {
                    $price = $this->productService->calculateProductPriceWithOffer($item, $request->currency_id);

                    array_push($invoice_items, [
                        'product_id' => $item['product_id'],
                        'quantity'=> $item['quantity'],
                        'currency_id' => $request->currency_id,
                        'original_price' =>$price['original'],
                        'cost' => $price['final'],
                        'discount_value' => $price['discount'],
                        'discount' => $offer->discount_value
                    ]);
                }
            }
        }


        //create invoice
        $invoice = $this->invoiceService->calculateInvoice($invoice_items);
        $created_invoice = $this->invoiceService->storeInvoice($invoice,$invoice_items);
        return $this->print($created_invoice);

    }

    /**
     * @param $item
     * @return \Illuminate\Support\Collection
     */
    public function groupingOffersItems($item)
    {
        return  Collect($item)->groupBy('offer_id');
    }

    /**
     * @param $invoice
     * @return mixed
     */
    public function print($invoice)
    {
        $discounts = [];

        foreach ($invoice->items as $item )
        {
            if ($item->pivot->discount !=0 && $item->offers[0]->pivot->discount_applicable == '1')
            {
                array_push($discounts,$item->pivot->discount.' off '. $item->name .' : -'. $item->pivot->discount_value);
            }

        }
        $output['subtotal'] = $invoice->subtotal_before_discount;
        $output['taxes'] = $invoice->tax;
        $output['discounts'] = $discounts;
        $output['total'] = $invoice->total;
        return $output;
    }


}
