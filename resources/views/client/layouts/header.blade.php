<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/client/style.css') }}">
		<link rel="stylesheet" href="{{ asset('css/font/css/all.css') }}">
	</head>
	<body>
		<div class="row menu">
			<div class="container">
				<ul class="list-menu">
					<a href="">
						<li style="padding-right: 50px">
							<img src="https://toeic24.vn/img/toeic24-logo.png">
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
								<a href="{{ route('client.gold', ['slug' => $gold->slug]) }}">{{ $gold->name }}</a>
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
				</ul>
			</div>
		</div>