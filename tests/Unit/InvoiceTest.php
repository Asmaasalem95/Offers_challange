<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use App\Services\InvoiceService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{

    use DatabaseMigrations;


    protected $invoiceRepository;

    protected $invoiceService;

   public function setUp(): void
   {
       parent::setUp(); // TODO: Change the autogenerated stub
       $InvoiceModelMockery = $this->createMock(Invoice::class);
       $this->invoiceRepository = new InvoiceRepository($InvoiceModelMockery);

       $this->invoiceService = new InvoiceService($this->invoiceRepository);
   }

    /**
     * @test
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
     function can_calculate_invoice()
    {
        $invoiceItems = [
            [
                "product_id" => 1,
                "quantity" => 1,
                "currency_id" => 1,
                "original_price" => 500.0,
                "cost" => 350.0,
                "discount_value" => 150.0,
                "discount" => 30,
            ],
            [
                "product_id" => 2,
                "quantity" => 1,
                "discount" => 0,
                "discount_value" => 0,
                "currency_id" => 1,
                "cost" => 700.0,
                "original_price" => 700.0,
            ]
        ] ;

        $invoice = $this->invoiceService->calculateInvoice($invoiceItems);
        //assert
        $this->assertEquals($invoice['subtotal_before_discount'],1200.0);
        $this->assertEquals($invoice['tax'],168.0);
        $this->assertEquals($invoice['subtotal_after_discount'],1050.0);
        $this->assertEquals($invoice['total'],1218.0);
    }


    /**
     * @test
     */
    function can_create_Invoice_with_invoice_items()
    {
        $invoiceItems =[
            [
                "product_id" => 1,
                "quantity" => 1,
                "currency_id" => 1,
                "cost" => 350.0,
                "discount_value" => 150.0,
                "discount" => 30,
                "original_price" => 500.0,
            ],
            [
                "product_id" => 2,
                "quantity" => 1,
                "discount" => 0,
                "discount_value" => 0,
                "currency_id" => 1,
                "cost" => 700.0,
                "original_price" => 700.0,
            ]
        ] ;

        $invoice = $this->invoiceService->calculateInvoice($invoiceItems);
        $created_invoice = $this->invoiceRepository->createInvoiceWithItems($invoice,$invoiceItems);

        //assert
        $this->assertEquals($created_invoice->subtotal_before_discount,$invoice['subtotal_before_discount']);
     /*   $this->assertEquals($invoice['tax'],168.0);
        $this->assertEquals($invoice['subtotal_after_discount'],1050.0);
        $this->assertEquals($invoice['total'],1218.0);*/

    }
}
