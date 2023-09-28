<?php
namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CheckoutService;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    private $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function index(Request $request)
    {
        $barang = DB::table('table_barang')->where('stok', '>', 0)->paginate(4);
        $status = DB::table('table_status')->get();
        return view('karyawan.pos.index', compact('barang', 'status'));
    }

    public function search(Request $request)
    {
        $search_text = $request->search;
        $barang = DB::table('table_barang')->where('nama_barang', 'LIKE', '%' . $search_text . '%')->where('stok', '>', 0)->paginate(4);
        $status = DB::table('table_status')->get();
        return view('karyawan.pos.index', compact('barang', 'status'));
    }

    public function checkout(Request $request)
    {
        $success = $this->checkoutService->checkout($request);

        if ($success) {
            alert()->success('Success', 'Pembelian Berhasil!');
            return redirect('/karyawan/pos')->with('status', 'Pembelian Berhasil!');
        } else {
            alert()->error('Error', 'Pembelian gagal!');
            return redirect('/karyawan/pos')->with('status', 'Pembelian gagal!');
        }
    }
}
?>