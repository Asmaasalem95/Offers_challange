<?php


namespace App\Repositories;


use App\Models\Invoice;
use App\Repositories\Contracts\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * @var Invoice
     */
    protected $model;

    /**
     * InvoiceRepository constructor.
     * @param Invoice $invoiceModel
     */
    public function __construct(Invoice $invoiceModel)
    {
        $this->model = $invoiceModel;
    }

    /**
     * @param array $invoiceData
     * @param array $items
     * @return mixed
     */
    public function createInvoiceWithItems(array $invoiceData, array $items)
    {
        // TODO: Implement createInvoiceWithItems() method.
        $invoice = $this->model->create($invoiceData);
        $invoice->items()->attach($items);
        return $invoice;
    }
}
