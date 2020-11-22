<?php


namespace App\Services;


use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Services\Contracts\InvoiceServiceInterface;

class InvoiceService implements InvoiceServiceInterface
{
    /**
     * @var InvoiceRepositoryInterface
     */
    protected $invoiceRepository;

    /**
     * InvoiceService constructor.
     * @param InvoiceRepositoryInterface $invoiceRepository
     */
    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }


    /**
     * @desc operate invoice calculations
     * @param $items
     * @return mixed
     */
    public function calculateInvoice($items)
    {
        $invoice['subtotal_before_discount'] = array_sum(array_column($items,'original_price'));

        $invoice['tax'] =  $invoice['subtotal_before_discount'] *14/100;

        $invoice['subtotal_after_discount'] = array_sum(array_column($items,'cost'));

        $invoice['total'] = $invoice['tax'] + $invoice['subtotal_after_discount'] ;

        return $invoice;
    }

    /**
     * @param $invoice
     * @param $invoiceItems
     * @return mixed
     */
    public function storeInvoice($invoice,$invoiceItems)
    {
        //Remove original_price key
        $items =  array_map(function($invoiceItems) {
            unset($invoiceItems['original_price']);
            return $invoiceItems ;
        },$invoiceItems);

        return $this->createInvoice($invoice,$items);
    }
    /**
     * @param $invoiceData
     * @param $items
     * @return mixed|void
     */
    public function createInvoice($invoiceData, $items)
    {
        // TODO: Implement createInvoice() method.

       return $this->invoiceRepository->createInvoiceWithItems($invoiceData,$items);
    }



}
