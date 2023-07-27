<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products = Product::paginate(3);
        return view('shopper.index', compact('products'));
    }

    public function halmakanan(){
        $products1 = Product::where('kategori', 'like', '%makanan%')->get();
        return view('shopper.index', compact('products1'));
    }

    public function info(){
        return view('shopper.pesan.product-details');
    }


    public function checkout(){
        return view('shopper.checkout');
    }

    public function halamanlogin(){
        return view('shopper.login');
    }

    public function halamanregister(){
        return view('shopper.register');
    }
}
