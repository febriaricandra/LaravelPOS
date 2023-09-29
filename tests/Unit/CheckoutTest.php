<?php

namespace Tests\Unit;
use App\Services\CheckoutService;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class CheckoutTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $checkoutService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->checkoutService = new CheckoutService(new IdGenerator());

        // Seed the database with data
        $this->seed();
    }

    /** @test */
    public function it_creates_an_order_and_order_items_and_updates_stock()
    {
        $request = new Request([
            'status' => 1,
            'harga_total' => 10000,
            'bayar' => 15000,
            'kembalian' => 5000,
            'submitOrder' => json_encode([
                [
                    'id' => 1,
                    'quantity' => 2,
                    'subtotal' => 5000,
                ],
                [
                    'id' => 2,
                    'quantity' => 1,
                    'subtotal' => 5000,
                ],
            ]),
        ]);

        $this->checkoutService->checkout($request);

        $this->assertDatabaseHas('table_order', [
            'id_status' => 1,
            'id_user' => 2, // assuming the authenticated user has an ID of 1
            'harga_total' => 10000,
        ]);

        $this->assertDatabaseHas('table_detail_order', [
            'id_order' => DB::table('table_order')->first()->id,
            'id_barang' => 1,
            'jumlah' => 2,
            'subtotal' => 5000,
            'bayar' => 15000,
            'kembalian' => 5000,
        ]);

        $this->assertDatabaseHas('table_detail_order', [
            'id_order' => DB::table('table_order')->first()->id,
            'id_barang' => 2,
            'jumlah' => 1,
            'subtotal' => 5000,
            'bayar' => 15000,
            'kembalian' => 5000,
        ]);

        $this->assertDatabaseHas('table_barang', [
            'id' => 1,
            'stok' => 8, // assuming the initial stock is 10
        ]);

        $this->assertDatabaseHas('table_barang', [
            'id' => 2,
            'stok' => 9, // assuming the initial stock is 10
        ]);
    }
}