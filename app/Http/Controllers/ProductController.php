<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
    {
        //get posts
        $products = Product::latest()->paginate(10);

        //render view with posts
        return view('products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang'=>'required|min:5',
            'harga'=>'required|integer|',
            'stok'=>'required|integer|',
            'keterangan'=>'required|min:5',
            'kategori'=>'required|min:5',
            'gambar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = date('Y-m-d').$gambar->getClientOriginalName();
        $path = 'products/'.$nama_gambar;

        Storage::disk('public')->put($path,file_get_contents($gambar));

        Product::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'kategori'=>$request->kategori,
            'gambar'=> $nama_gambar
            
        ]);

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param mixed $product
     * @return void
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * @param  mixed $request
     * @param  mixed $post
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
            
                $this->validate($request, [
                    'nama_barang'=>'required|min:5',
                    'harga'=>'required|integer|',
                    'stok'=>'required|integer|',
                    'keterangan'=>'required|min:5',
                    'kategori'=>'required|min:5',
                    'gambar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);    
           

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $gambar = $request->file('gambar');
            $nama_gambar = date('Y-m-d').$gambar->getClientOriginalName();
            $path = 'products/'.$nama_gambar;

            Storage::disk('public')->put($path,file_get_contents($gambar));
            //delete old image
            Storage::delete('products/'.$product->gambar);


            //update post with new image
            $product->update([
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'keterangan' => $request->keterangan,
                'kategori'=>$request->kategori,
                'gambar'=> $nama_gambar
            ]);

        } else {

            //update post without image
            $product->update([
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'keterangan' => $request->keterangan
            ]);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
         //delete image
         Storage::delete('public/product/'. $product->nama_barang);

         //delete post
         $product->delete();
 
         //redirect to index
         return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
