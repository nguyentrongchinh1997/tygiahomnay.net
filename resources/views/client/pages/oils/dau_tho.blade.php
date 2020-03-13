@extends('client.layouts.index')

@section('title', 'Giá dầu thô thế giới - Crude Oil (Brent) UKOIL, Crude Oil (WTI) USOIL')
@section('keywords', 'giá dầu thô, giá dầu mỏ, giá dầu thế giới, giá dầu quốc tế, giá một thùng dầu thô, giá dầu US OIL, giá dầu Mỹ, giá dầu Anh, giá dầu UK OIL, dầu thế giới, diễn biến dầu thô, diễn biến giá dầu, biểu đồ giá dầu, bảng giá dầu thô, Crude Oil, Crude Oil (Brent), Live charts Crude Price Brent UKOIL, Crude Oil (WTI) USOIL, Live charts Crude Price WTI USOIL, FX:UKOIL, FX:USOIL, UKOIL, USOIL, WTI USOIL')
@section('description', 'Giá dầu thô mới nhất hôm nay. Giá dầu mỏ thế giới mới nhất, giaá dầu thế giới, Crude Oil (Brent), Live charts Crude Price Brent UKOIL, Crude Oil (WTI) USOIL, Live charts Crude Price WTI USOIL, FX:UKOIL, FX:USOIL. Cập nhật Gia xang dau the gioi, giá dầu thế giới, xang dau the gioi, gia dau the gioi, giá dầu khí thế giới')

@section('content')
<div class="row list-category">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul>
					<li style="@if($slug == config('config.oil.petrolimex')){{'background: #e1e1e1'}}@endif">
						<a href="{{ route('client.oil') }}">
							Petrolimex
						</a>
					</li>
					<li style="@if($slug == config('config.oil.dau-tho')){{'background: #e1e1e1'}}@endif">
						<a href="{{ route('client.crude') }}">
							Dầu thô
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-9 bank-left">
			<h1 class="h1">
				Biểu đồ giá dầu thô thế giới
			</h1>
			<h2 class="h2">
				Crude Oil (Brent) - UKOIL
			</h2><br>
			<iframe src="https://s.tradingview.com/widgetembed/?frameElementId=tradingview_fc42e&symbol=TVC%3AUKOIL&interval=1&symboledit=1&saveimage=1&toolbarbg=f1f3f6&studies=%5B%5D&hideideas=1&theme=White&style=1&timezone=Asia%2FBangkok&studies_overrides=%7B%7D&overrides=%7B%7D&enabled_features=%5B%5D&disabled_features=%5B%5D&locale=vi_VN&referral_id=1713&utm_source=webgia.com&utm_medium=widget&utm_campaign=chart&utm_term=TVC%3AUKOIL"></iframe>
			<h2 style="margin-top: 20px" class="h2">
				Crude Oil (WTI) - USOIL
			</h2>
			<br>
			<iframe src="https://s.tradingview.com/widgetembed/?frameElementId=tradingview_1e92e&symbol=TVC%3AUSOIL&interval=1&symboledit=1&saveimage=1&toolbarbg=f1f3f6&studies=%5B%5D&hideideas=1&theme=White&style=1&timezone=Asia%2FBangkok&studies_overrides=%7B%7D&overrides=%7B%7D&enabled_features=%5B%5D&disabled_features=%5B%5D&locale=vi&referral_id=1713&utm_source=webgia.com&utm_medium=widget&utm_campaign=chart&utm_term=TVC%3AUSOIL"></iframe>
			<br>
			@include('client.includes.news_random')
		</div>
		<div class="col-lg-3 right">
			@include('client.includes.usd_sidebar')
			@include('client.includes.new_news')
		</div>
	</div>
</div>
@endsection