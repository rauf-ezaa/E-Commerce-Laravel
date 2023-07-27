<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use Auth;

class HistoryController extends Controller
{
    public function index()
    {
    	$pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=',0)->get();

    	return view('shopper.history', compact('pesanans'));
    }

    public function detail($id)
    {
    	$pesanans = Pesanan::where('id', $id)->first();
    	$pesanan_details = PesananDetail::where('pesanan_id', $pesanans->id)->get();

     	return view('shopper.history_detail', compact('pesanans','pesanan_details'));
    }
}
