@extends('client.layouts.index')

@section('title', 'Giá vàng Bảo Tín Minh Châu - Vàng Bạc Đá Quý Bảo Tín Minh Châu')

@section('description', 'Giá vàng Bảo Tín Minh Châu mới nhất hôm nay. Vàng btmc, gia vang btmc, gia vang SJC, vàng btmc 9999, giá vàng, gia vang, trang sức, vang bac minh chau, vàng miếng, nhẫn sjc, sjc trang sức, nhẫn cưới, vàng nguyên liệu 99.99, vàng bốn số 9, vàng nguyên liệu 99.9, nữ trang 99.99, nữ trang bốn số 9, nữ trang 99.9, nữ trang 99, nữ trang 75, nữ trang 58.3, nữ trang 41.7, sjc tại hà nội, sjc đà nẵng, sjc hcm, sjc hồ chí minh')

@section('keywords', 'btmc, vang bac minh chau, vàng miếng, bản vàng đắc lộc, nhẫn tròn trơn, vàng trang sức, vàng bản vị, vàng thỏi, vàng nén, vàng BTMC, vàng HTBT, vàng thị trường, vàng 750, vàng 700, vàng 16.8k, vàng 680, vàng 16.3k, vàng 585, vàng 14k, vàng 37.5, vàng 9k, vàng nguyên liệu btmc, vàng nguyên liệu thị trường, sjc, vàng, bạc, đá quý, kim cương, nữ trang, vàng sjc')

@section('content')
<div class="row list-category">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul>
					@foreach ($goldList as $goldItem)
						<li style="@if($goldItem->slug == $slug){{'background: #e1e1e1'}}@endif">
							<a href="{{ route('client.gold', ['name' => $goldItem->slug]) }}">
								{{ $goldItem->name }}
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
		<div class="col-lg-9 bank-left">
			<h1 class="h1">
				Giá vàng Bảo Tín Minh Châu Việt Nam
			</h1>
			<p>
				Giá vàng Bảo Tín Minh Châu Việt Nam cập nhất <b>mới nhất vào lúc {{ date('H:i:s d/m/Y', strtotime($recent_day_detail)) }}</b>
			</p>
			<br>
			<form method="GET" action="{{ url()->current() }}">
				<p id="datepicker" style="text-align: center;">
					<input value="{{ $recent_day }}" autocomplete="off" name="date" value="" id="datepicker" class="datepicker">
					<button>Tra cứu</button>
				</p>
				<p style="color: red;margin-top: 10px; font-style: italic; text-align: right;">
					Đơn vị: nghìn đồng/lượng
				</p>
			</form>
			<div class="row data-table">
				@if ($check > 0)
				<table class="doji">
					<tr>
						<th>
							Loại vàng
						</th>
						<th style="text-align: center;">
							Mua vào
						</th>
						<th style="text-align: center;">
							Bán ra
						</th>
					</tr>
					@foreach($goldDetails as $item)
						<tr>
							<td>{{ $item->type }}</td>
							<td class="price">
								{{ $item->buy }}
							</td>
							<td class="price">
								{{ $item->sell }}
							</td>
						</tr>
					@endforeach
				</table>
				<br>
				<p class="origin" style="text-align: right;">Nguồn: Tập đoàn Vàng Bạc Đá Quý Bảo Tín Minh Châu</p>
				@else
					<div class="alert alert-warning">
						Xin lỗi, chắc có chút nhầm lẫn nho nhỏ :(<br>
						Ngày <b>{{ $recent_day }}</b>, hệ thống chúng tôi không thể dự báo được tỷ giá vàng cho ngày này.<br>
						Bạn có thể tra cứu tỷ giá vàng ở ô bên trên.
					</div>
				@endif
			</div>
			<div class="info">
				{!! $gold->info !!}
			</div>
		</div>
		<div class="col-lg-3 right">
			@include('client.includes.oil_sidebar')
		</div>
	</div>
</div>
@endsection