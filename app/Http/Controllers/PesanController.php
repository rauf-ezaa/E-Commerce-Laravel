<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PesananDetail;

class PesanController extends Controller
{
    public function index($id)
    {
    	$products = Product::where('id', $id)->findOrFail($id);

    	return view('shopper.pesan.product-details', compact('products'));
    }

    public function pesan(Request $request, $id)
    {	
    	$products = product::where('id', $id)->first();
    	$tanggal = Carbon::now();

    	//validasi apakah melebihi stok
    	if($request->jumlah_pesan> $products->stok)
    	{
    		return redirect('pesan/'.$id);
    	}

    	//cek validasi
    	$cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
    	//simpan ke database pesanan
    	if(empty($cek_pesanan))
    	{
    		$pesanan = new Pesanan;
	    	$pesanan->user_id = Auth::user()->id;
	    	$pesanan->tanggal = $tanggal;
	    	$pesanan->status = 0;
	    	$pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
	    	$pesanan->save();
    	}
    	

    	//simpan ke database pesanan detail
    	$pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

    	//cek pesanan detail
    	$cek_pesanan_detail = PesananDetail::where('product_id', $products->id)->where('pesanan_id', $pesanan_baru->id)->first();
    	if(empty($cek_pesanan_detail))
    	{
    		$pesanan_detail = new PesananDetail;
	    	$pesanan_detail->product_id = $products->id;
	    	$pesanan_detail->pesanan_id = $pesanan_baru->id;
	    	$pesanan_detail->jumlah = $request->jumlah_pesan;
	    	$pesanan_detail->jumlah_harga = $products->harga*$request->jumlah_pesan;
	    	$pesanan_detail->save();
    	}else 
    	{
    		$pesanan_detail = PesananDetail::where('product_id', $products->id)->where('pesanan_id', $pesanan_baru->id)->first();

    		$pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;

    		//harga sekarang
    		$harga_pesanan_detail_baru = $products->harga*$request->jumlah_pesan;
	    	$pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
	    	$pesanan_detail->update();

    	}
		$pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
		$pesanan->jumlah_harga = $pesanan->jumlah_harga+$products->harga*$request->jumlah_pesan;
		$pesanan->update();
    	
    	
    	return redirect('/shopper');

    }

	public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();


        $pesanan_detail->delete();


        return redirect('check-out');
    }
	public function check()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(empty($pesanan)){
			return redirect()->route('home')->with(['error' => 'oops nampaknya kamu belum menambahkan barang kedalam keranjang!']);
		}
		if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
			return view('shopper.checkout', compact('pesanan', 'pesanan_details'));
        }
       
      
    }

	public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
			$products = Product::where('id', $pesanan_detail->product_id)->first();
			$products->stok = $products->stok-$pesanan_detail->jumlah;
            $products->update();
        }
        return redirect('history');
        
	}
}
