<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BIG BURGER</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>	
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->


<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +62 81212231033</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> bigburger@customer.com</a></li>
							</ul>
						</div>
					</div>


					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
							<script>
							//message with toastr
								@if(session()->has('success'))
								
									toastr.success('{{ session('success') }}', 'BERHASIL!'); 

								@elseif(session()->has('error'))

									toastr.error('{{ session('error') }}', 'GAGAL!'); 
									
								@endif
    						</script>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo2.jpeg" width="150px" height="150px" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									ID
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="index.html">English</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Currency
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="index.html">Rupiah</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
							
								@guest
								<li class="nav-item">
									<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
									<a class="nav-link" href="{{ route('register') }}">{{ __('register') }}</a>
								</li>
						
							</ul>
						</div>
					</div>
					<ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        
                           
                        @else
                        <li class="nav-item">
                                <?php
                                 $pesanan_utama = \App\Models\Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
                                 if(!empty($pesanan_utama))
                                    {
                                     $notif = \App\Models\PesananDetail::where('pesanan_id', $pesanan_utama->id)->count(); 
                                    }
                                ?>
                                <a class="nav-link" href="{{ url('check-out') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    @if(!empty($notif))
                                    <span class="badge badge-danger">{{ $notif }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav navbar-nav collapse navbar-collapse">
									<li class="dropdown"><a href="#">{{ Auth::user()->name }}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('history') }}">Riwayat Checkout</a></li>
										<li><a href="{{ url('logout') }}">Logout</a></li>
                                    </ul>
                                </li>
                                </a>

                                <div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								

                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                      
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html" class="active">Home</a></li>
								
							</ul>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>BIG</span> BURGER</h1>
									<h2>"Temukan dunia rasa kenikmatan Big Burger, rasakan kelezatannya!"</h2>
									<p></p>
									<button type="button" class="btn btn-default get">Dapatkan Sekarang</button>
								</div>
								<div class="col-sm-6">
									<img src="images/banner/makanburger.jpg" class="girl img-responsive" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>BIG</span> BURGER</h1>
									<h2>"Temukan dunia rasa kenikmatan Big Burger, rasakan kelezatannya!"</h2>
									<p> </p>
									<button type="button" class="btn btn-default get">Dapatkan Sekarang</button>
								</div>
								<div class="col-sm-6">
									<img src="images/banner/banner2.jpg" class="girl img-responsive" alt="" />
								</div>
							</div>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2></h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href=""></a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="minuman.html"></a></h4>
								</div>
							</div>
						</div><!--/category-products-->
					
						
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/banner/banner1.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Item Terlaris</h2>

						@foreach($products as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ Storage::url('public/products/').$product->gambar }}" alt="" />
											<h2>Rp. {{ number_format($product->harga)}}</h2>
											<p>{{ $product->nama_barang }}</p>
											<a href="{{ url('/pesan/'. $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
								</div>
							</div>
						</div>

						
						@endforeach
						{{ $products->links() }}
						

						
					</div><!--features_items-->
					
					
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->	
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="index.html">Home</a></li>
								<li><a href="makanan.html"></a></li>
								<li><a href="contact-us.html">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Menu</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="makanan.html">Makanan</a></li>
								<li><a href="minuman.html">Minuman</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-5">
						<div class="single-widget">
							<h2>About Shop</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>


   
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright 2023 Kelompok Pemrograman Web. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
	
</body>
</html>