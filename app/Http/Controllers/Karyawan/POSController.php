<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    //
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $barang = DB::table('table_barang')->paginate(4);
        return view('karyawan.pos.index', compact('barang', 'cart'));
    }

    public function add_to_cart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $id = $request->id;
        $barang = DB::table('table_barang')->where('id', $id)->first();
        $cart[$id] = [
            'id' => $id,
            'nama_barang' => $barang->nama_barang,
            'harga_jual' => $barang->harga_jual,
            'qty' => 1,
        ];
        $request->session()->put('cart', $cart);
        return redirect('/karyawan/pos');
    }

    public function remove_from_cart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $id = $request->id;
        unset($cart[$id]);
        $request->session()->put('cart', $cart);
        return redirect('/karyawan/pos');
    }

    public function clear_cart(Request $request)
    {
        $request->session()->forget('cart');
        return redirect('/karyawan/pos');
    }

    public function add_qty(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $id = $request->id;
        $cart[$id]['qty']++;
        $request->session()->put('cart', $cart);
        return redirect('/karyawan/pos');
    }

    public function reduce_qty(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $id = $request->id;
        $cart[$id]['qty']--;
        if ($cart[$id]['qty'] == 0) {
            unset($cart[$id]);
        }
        $request->session()->put('cart', $cart);
        return redirect('/karyawan/pos');
    }

    public function search(Request $request)
    {
        $search_text = $request->search;
        $barang = DB::table('table_barang')->where('nama_barang', 'LIKE', '%' . $search_text . '%')->paginate(4);
        return view('karyawan.pos.index', compact('barang'));
    }
}
