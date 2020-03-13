@extends('client.layouts.index')

@section('title', 'Website cập nhật liên tục tỷ giá Đô la, Giá vàng, Lãi suất ngân hàng')
@section('description', 'Tỷ giá ngoại tệ ngày hôm nay: tỷ giá Đô La, Euro, Yên Nhật, Nhân Dân Tệ,...Giá vàng SJC, DOJI, PNJ... hiện tại, lãi suất liên ngân hàng Vietinbank, Vietcombank, Techcombank. BIDV')
@section('keywords', 'tỷ giá đô la, tỷ giá hôm nay, tỷ giá ngân hàng agirbank, tỷ giá ngân hàng vietinbank, tỷ giá ngân hàng sacombank, tỷ giá ngân hàng bidv,....lãi suất ngân hàng, giá vàng hôm nay, giá vàng sjc, giá vàng doji')

@section('content')
<div class="row list-category">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul>
					@foreach ($banks as $bankItem)
					<li>
						<a href="{{ route('client.bank', ['name' => $bankItem->name]) }}">
							{{ $bankItem->name }}
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 col-lg-9">
			<h1 class="h1" style="font-size: 20px; font-weight: normal;">Tỷ giá vàng hôm nay <b>{{ date('d/m/Y') }}</b></h1>
			<p style="font-size: 14px; font-style: italic; text-align: right; color: red">Đơn vị: ngàn đồng / lượng</p>
			<table class="table">
				<tr>
					<td colspan="3" style="font-weight: bold; text-align: center; font-size: 18px">
						Cập nhật giá vàng {{ date('H:i:s d/m/Y', strtotime($dateUpdatePriceGold)) }}
					</td>
				</tr>
				<tr>
					<th>Loại</th>
					<th>Mua vào</th>
					<th>Bán ra</th>
				</tr>
				@foreach ($priceGoldToday as $price)
					<tr>
						<td>
							{{ $price->type }}
						</td>
						<td style="text-align: center;">
							{{ $price->buy }}
						</td>
						<td style="text-align: center;">
							{{ $price->sell }}
						</td>
					</tr>
				@endforeach
			</table>
			<br><br>
			
			<h1 class="h1" style="font-size: 20px; font-weight: normal;">Tỷ giá Đô La Mỹ (USD) ngày hôm nay - <b>{{ date('d/m/Y') }}</b></h1>
			<div class="data-table">
				<table class="table">
					<tr style="background: #0066b3; color: #fff">
						<th>
							Ngân hàng
						</th>
						<th>Mua</th>
						<th>Mua CK</th>
						<th>Bán</th>
						<th>Bán CK</th>
					</tr>
					@foreach ($currency as $price)
					<tr>
						<th style="text-transform: capitalize;">
							{{ $price->bank->name }}
						</th>
						<td>
							{{ format($price->buy) }}
						</td>
						<td>
							{{ format($price->transfer) }}
						</td>
						<td>
							{{ format($price->sell) }}
						</td>
						<td>
							{{ format($price->sell_transfer) }}
						</td>
					</tr>

					@endforeach
				</table>
			</div>
			<br>
			<br>
			<h1 class="h1" style="font-size: 20px; font-weight: normal;">Biểu đồ tỷ giá Euro (EUR) ngân hàng Vietinbank - <b>tháng {{ date('m/Y') }}</b></h1>
			<table style="margin: auto;">
				<tr>
					<td>
						<span style="width: 50px; height: 10px; background: #ff6300; display: block;"></span>
					</td>
					<td style="padding: 0px 10px">
						Bán ra
					</td>
					<td style="padding: 0px 10px 0px 20px">
						<span style="width: 50px; height: 10px; background: #0066b3; display: block;"></span>
					</td>
					<td style="padding: 0px 10px">
						Mua vào
					</td>
				</tr>
			</table>
			<div class="row">
				{!! $usersChart->container() !!}
				{!! $usersChart->script() !!}
			</div>
			<br><br>
			<div class="info">
			<h1 class="h1" style="font-size: 20px; font-weight: normal; margin-bottom: 20px">Giới thiệu</h1>
			<p>
				<b><a href="{{ route('client.home') }}">Tygiahomnay.net</a></b> với mục đích ban đầu là cập nhật dữ liệu về giá vàng, giá xăng dầu, lãi xuất ngân hàng, tỷ giá ngân hàng, tỷ giá ngoại tệ của các tổ chức, ngân hàng tại Việt Nam. 
				<p>Qua thời gian phát triển, nhận được nhiều ý kiến đóng góp từ độc giả, <b><a href="{{ route('client.home') }}">Tygiahomnay.net</a></b> đã ngày càng nâng cấp và hoàn thiện hơn, thêm nhiều chức năng mới, nhằm phục vụ nhu cầu thông tin của mọi người.</p>
			</p>
			<h1 class="h1" style="font-size: 20px; font-weight: normal; margin-bottom: 20px">Chức năng nổi bật</h1>
			<p>
				+ Cập nhật giá vàng, tỷ giá ngân hàng, tỷ giá ngoại tệ, giá xăng dầu, lãi xuất ngân hàng với thời gian nhanh nhất.
			</p>
			<p>
				+ Tra cứu lịch sử tỷ giá ngoại tệ ngân hàng <a href="ty-gia/vietinbank">Vietinbank</a>, <a href="ty-gia/vietcombank">Vietcombank</a>, <a href="ty-gia/techcombank">Techcombank</a>, <a href="ty-gia/sacombank">Sacombank</a>, <a href="ty-gia/bidv">BIDV</a>, <a href="ty-gia/agribank">Agribank</a>, <a href="ty-gia/tpbank">TPbank</a>
			</p>
			<p>
				+ So sánh tỷ giá ngoại tệ tại các ngân hàng Việt Nam, giúp người dùng có thể xem mua ngoại tệ ở ngân hàng nào giá tốt nhất và bán ngoại tệ ở ngân hàng nào giá tốt nhất.
			</p>
			<p>
				+ Biểu đồ giá vàng thế giới, <a href="gia-xang-dau/dau-tho">giá dầu thô thế giới</a> theo thời gian thực.
			</p>
			</div>
		</div>
		<div class="col-12 col-md-4 col-lg-3 right">
			@include('client.includes.oil_sidebar')
			@include('client.includes.new_news')
		</div>
	</div>
</div>
@endsection