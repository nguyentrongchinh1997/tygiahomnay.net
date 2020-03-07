<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="@yield('keywords')">
    	<meta name="description" content="@yield('description')">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/client/style.css') }}">
		<link rel="stylesheet" href="{{ asset('css/font/css/all.css') }}">
		<link rel="icon" type="image/png" href="{{ asset('favicons/favicons.png') }}" sizes="32x32">
	</head>
	<body>
		<div class="row menu-mobile">
			<div class="container">	
				<i class="menu-icon fas fa-bars"></i>
				<a href="{{ route('client.home') }}">
					<img class="logo-mobile" src="{{ asset('image/logo_mobile.png') }}" style="width: 200px">
				</a>
				<div class="menu-mobile-list">
					<ul>
						<li>
							<a href="{{ route('client.home') }}">
								<img src="{{ asset('image/logo_mobile.png') }}" style="width: 60%;margin: 0px">
							</a>
							<i class="exit fas fa-times"></i>
						</li>
						<li class="menu-mobile-item">
							<a href="#">
								Tỷ giá ngân hàng <i class="fas fa-chevron-down"></i>
							</a>
							<ul>
								@foreach ($banks as $bank)
									<li>
										<a href="{{ route('client.bank', ['name' => $bank->name]) }}">{{ $bank->name }}</a>
									</li>
								@endforeach
							</ul>
						</li>
						<li class="menu-mobile-item">
							<a href="#">
								Giá vàng <i class="fas fa-chevron-down"></i>
							</a>
							
							<ul style="min-width: 400px">
								@foreach ($golds as $gold)
									<li>
										<a href='{{ asset("/gia-vang/$gold->slug") }}'>{{ $gold->name }}</a>
									</li>
								@endforeach
							</ul>
						</li>
						<li class="menu-mobile-item">
							<a href="#">
								Giá xăng dầu <i class="fas fa-chevron-down"></i>
							</a>
							
							<ul>
								<li style="width: 100%">
									<a href="{{ route('client.oil') }}">
										Dầu Petrolimex
									</a>
								</li>
								<li style="width: 100%">
									<a href="{{ route('client.crude') }}">
										Dầu thô
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-mobile-item">
							<a href="#">
								Ngoại tệ <i class="fas fa-chevron-down"></i>
							</a>
							<ul>
								@foreach ($currencies as $currency)
									<li style="width: 50%; float: left;">
										<a href="{{ route('client.currency', ['name' => $currency->currency_code]) }}" title="{{ $currency->name }}">
											<img src='{{ asset("upload/lang/$currency->image") }}'>
											{{ $currency->currency_code }}
										</a>
									</li>
								@endforeach
								<div style="clear: both;"></div>
							</ul>
						</li>
						<li>
							<a href="{{ route('client.interest') }}">Lãi xuất</a>
						</li>
					</ul>
				</div>
			</div>	
		</div>
		<div class="row menu">
			<div class="container">
				<ul class="list-menu">
					<a href="{{ route('client.home') }}">
						<li style="padding-right: 50px">
							<img src="https://scontent.fhan2-3.fna.fbcdn.net/v/t1.15752-9/87485930_511735642818871_9034427474791890944_n.jpg?_nc_cat=108&_nc_sid=b96e70&_nc_ohc=jTKL84QWegsAX_Hph1y&_nc_ht=scontent.fhan2-3.fna&oh=ebb6f379cb799934f40e15dfdd3ba81c&oe=5E918367" style="width: 170px">
						</li>
					</a>
					<li class="sub-menu">
						Tỷ giá ngân hàng <i class="fas fa-sort-down"></i>
						<ul>
							@foreach ($banks as $bank)
							<li>
								<a href="{{ route('client.bank', ['name' => $bank->name]) }}">{{ $bank->name }}</a>
							</li>
							@endforeach
						</ul>
					</li>
					<li class="sub-menu">
						Giá vàng <i class="fas fa-sort-down"></i>
						<ul style="min-width: 400px">
							@foreach ($golds as $gold)
								<li>
									<a href='{{ asset("/gia-vang/$gold->slug") }}'>{{ $gold->name }}</a>
								</li>
							@endforeach
						</ul>
					</li>
					<li class="sub-menu">
						Ngoại tệ <i class="fas fa-sort-down"></i>
						<ul style="min-width: 510px">
							@foreach ($currencies as $currency)
							<li style="width: 170px">
								<a href="{{ route('client.currency', ['name' => $currency->currency_code]) }}" title="{{ $currency->name }}">
									<img src='{{ asset("upload/lang/$currency->image") }}'>
									{{ $currency->currency_code }}
								</a>
							</li>
							@endforeach
						</ul>
					</li>
					<li class="sub-menu">
						Giá xăng dầu <i class="fas fa-sort-down"></i>
						<ul>
							<li style="width: 100%">
								<a href="{{ route('client.oil') }}">
									Dầu Petrolimex
								</a>
							</li>
							<li style="width: 100%">
								<a href="{{ route('client.crude') }}">
									Dầu thô
								</a>
							</li>
						</ul>
					</li>
					<li class="sub-menu">
						<a href="{{ route('client.interest') }}">Lãi xuất</a>
					</li>
				</ul>
			</div>
		</div>