@extends('client.layouts.index')

@section('title', 'Giá vàng SJC Việt Nam - Vàng Bạc Đá Quý Sài Gòn')

@section('description', 'Cập nhật giá vàng SJC mới nhất hôm nay. Giaá vàng SJC 1 lượng, vàng nhẫn SJC 9999, vàng 5 phân, 1 chỉ, 2 chỉ, 5 chỉ, vàng nữ trang 9999, vàng nữ trang 75, nữ trang 58.3, nữ trang 41.7. Giá vàng SJC tại Tp Hồ Chí Minh (Sài gòn), Hà Nội (HN), Đà Nẵng, Nha Trang, Cà Mau, Buôn Ma Thuột, Bình Phước, Huế, Biên Hòa, SJC Miền Tây, Quãng Ngãi, Đà Lạt, Long Xuyên.')

@section('keywords', 'giá vàng sjc, sjc hom nay, sjc, vàng, bạc, đá quý, kim cương, nữ trang, vàng sjc, giao dịch vàng, giá vàng, kinh doanh vàng, buôn vàng, bán vàng, biến động giá vàng, tư vấn vàng, website vàng, diễn đàn vàng, đánh vàng, vàng vật chất, vàng tài khoản, nhẫn, khuyên tai, vòng, kiềng, lắc, giá vàng sjc, giá vàng 9999, vàng 18k, vàng 24k, bảng giá vàng online trong nước,gia vang hom nay, giá vàng hôm nay, giavang, giá vàng, gia vang SJC, giá vàng 9999, giá vàng sjc, giá vàng online, tỷ giá vàng')

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
				Giá vàng SJC Việt Nam
			</h1>
			<p>
				Giá vàng SJC Việt Nam cập nhất <b>mới nhất vào lúc {{ date('H:i:s d/m/Y', strtotime($recent_day_detail)) }}</b>
			</p>
			<br>
			<form method="GET" action="{{ url()->current() }}">
				<p id="datepicker" style="text-align: center;">
					<input value="{{ $recent_day }}" autocomplete="off" name="date" value="" id="datepicker" class="datepicker">
					<button>Tra cứu</button>
				</p>
				<p style="color: red;font-style: italic; text-align: right;">
					Đơn vị: ngàn đồng/lượng
				</p>
			</form>
			<div class="row data-table">
				@if ($check > 0)
					<table>
						<tr>
							<th></th>
							<th>Loại</th>
							<th>Mua vào</th>
							<th>Bán giá</th>
						</tr>
						@foreach ($goldDetails as $item)
							@php $k = ++$stt; @endphp
							@if ($k == 1 || $k > 8)
								<tr>
									@if ($item->city_id == config('config.city.hcm'))
										@php $rowspan = 8; @endphp
									@else
										@php $rowspan = 1; @endphp
									@endif
									<th rowspan="{{ $rowspan }}">
										{{ $item->city->name }}
									</th>
									<td>
										{{ $item->type }}
									</td>
									<td style="text-align: right;">
										{{ $item->buy }}
									</td>
									<td style="text-align: right;">
										{{ $item->sell }}
									</td>
								</tr>
							@else
								<tr>
									<td>
										{{ $item->type }}
									</td>
									<td style="text-align: right;">
										{{ $item->buy }}
									</td>
									<td style="text-align: right;">
										{{ $item->sell }}
									</td>
								</tr>
							@endif
						@endforeach
					</table>
					<br>
					<p class="origin" style="text-align: right;">Nguồn: Công Ty TNHH Một Thành Viên Vàng Bạc Đá Quý Sài Gòn – SJC</p>
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
			@include('client.includes.usd_sidebar')
		</div>
	</div>
</div>
@endsection