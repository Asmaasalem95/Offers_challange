<?php


namespace App\Services\Contracts;


interface InvoiceServiceInterface
{
    /**
     * @param $items
     * @return mixed
     */
    public function calculateInvoice($items);

    /**
     * @param $invoice
     * @param $invoiceItems
     * @return mixed
     */
    public function storeInvoice($invoice,$invoiceItems);

    /**
     * @param $invoiceData
     * @param $items
     * @return mixed
     */
    public function createInvoice($invoiceData,$items);
}
