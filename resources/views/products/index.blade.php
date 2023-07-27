<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah data product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA PRODUCT</a>
                        <a href="{{ route('logout') }}" class="btn btn-md btn-success mb-3">LOGOUT</a>
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
                                        <img src="{{ Storage::url('public/products/').$products->gambar }}" class="rounded" style="width: 150px">
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

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
        @endif
    </script>

</body>
</html>