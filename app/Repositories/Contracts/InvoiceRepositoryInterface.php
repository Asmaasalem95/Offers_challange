<?php


namespace App\Repositories\Contracts;


interface InvoiceRepositoryInterface
{
    /**
     * @param array $invoiceInfo
     * @param array $items
     * @return mixed
     */
    public function createInvoiceWithItems(array $invoiceInfo,array $items);

}
