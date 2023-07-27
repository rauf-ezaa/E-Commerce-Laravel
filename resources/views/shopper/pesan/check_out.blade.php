
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                </ol>
            </nav>
        </div>
        <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA PRODUCT</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">GAMBAR</th>
                                <th scope="col">NAMA_BARANG</th>
                                <th scope="col">HARGA_BARANG</th>
                                <th scope="col">STOK_BARANG</th>
                                <th scope="col">KETERANGAN_BARANG</th>
                                <th scope="col">KATEGORI_BARANG</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($products as $products)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ url('public/products/').$products->gambar }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $products->nama_barang }}</td>
                                    <td>{!! $products->harga !!}</td>
                                    <td>{!! $products->stok !!}</td>
                                    <td>{!! $products->keterangan !!}</td>
                                    <td>{!! $products->kategori !!}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $products->id) }}" method="POST">
                                            <a href="{{ route('products.edit', $products->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                           
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Product belum Tersedia.
                                  </div>
                              @endforelse
                              
                            </tbody>
                          </table>  

                         
                          <!--  -->
                    </div>
                </div>
            </div>
        </div>
    </div>

                    <tr>
                               
                    
                </div>
            </div>
        </div>
        
    </div>
</div>