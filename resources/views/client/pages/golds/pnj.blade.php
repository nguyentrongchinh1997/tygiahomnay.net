@extends('client.layouts.index')

@section('title', 'Giá vàng PNJ Việt Nam - Trang Sức Cao Cấp PNJ - Vàng Bạc Đá Quý Phú Nhuận')

@section('description', 'Cập nhật giá vàng PNJ mới nhất hôm nay. Giá vàng SJC 1 lượng, vàng thẻ PNJ DAB, vàng bóng đổi 9999, vàng pnj nữ trang, nhẫn pnj, nhẫn 24k. Giaá nữ trang 24k, nữ trang 18k, nữ trang 14k, nữ trang 10k, vàng trắng, pnj đông á. Giá vàng pnj hồ chí minh, pnj hcm, pnj hà nội, pnj đà nẵng, pnj cần thơ')

@section('keywords', 'giá vàng pnj, trang sức pnj, bạc pnj, bạc cao cấp pnj, bạc, đá quý, dây chuyền, bông tai, nhẫn pnj, nữ trang 24k, nữ trang 18k, nữ trang 14k, nữ trang 10k, sjc, vàng, bạc, đá quý, kim cương, nữ trang, vàng sjc, nhẫn, khuyên tai, vòng, kiềng, lắc, giá vàng sjc, giá vàng 9999, vàng 18k, vàng 24k, pnj hồ chí minh, pnj hcm, pnj hà nội, pnj đà nẵng, pnj cần thơ, bảng giá vàng online trong nước,gia vang hom nay')

@section('content')
<div class="row list-category">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul>
					@foreach ($goldList as $goldItem)
							<li style="@if($goldItem->slug == $slug){{'background: #e1e1e1'}}@endif">
								<a href="{{ route('client.gold', ['name' => $goldItem->symbol]) }}">
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
				Giá vàng DOJI Việt Nam
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
				<p style="color: red;margin-top: 10px; font-style: italic; text-align: right;">
					Đơn vị: ngàn đồng/lượng
				</p>
			</form>
			<div class="row data-table">
				@if ($check > 0)
					<table class="doji">
						<tr>
							<th>
								Khu vực
							</th>
							<th style="text-align: center;">
								Loại
							</th>
							<th style="text-align: center;">
								Mua vào
							</th>
							<th style="text-align: center;">
								Bán ra
							</th>
							<th>
								Thời gian cập nhật
							</th>
						</tr>
						@foreach ($goldDetails as $item)
							@php $k = ++$stt @endphp
							@if ($k == 1 || $k == 4 || $k == 6 || $k == 8 || $k == 10)
								<tr>
									@if ($item->city_id == config('config.city.hcm'))
										@php $rowspan = 3; @endphp
									@elseif($item->city_id == config('config.city.hn') || $item->city_id == config('config.city.dn') || $item->city_id == config('config.city.ct'))
										@php $rowspan = 2; @endphp
									@elseif($item->city_id == config('config.city.other'))
										@php $rowspan = 5; @endphp
									@endif
									<th rowspan="{{ $rowspan }}">
											{{ $item->city->name }}
									</th>
									<td>{{ $item->type }}</td>
									<td class="price">{{ $item->buy }}</td>
									<td class="price">{{ $item->sell }}</td>
									<td>{{ date('H:i:s d/m/Y', strtotime($item->updated_at)) }}</td>
								</tr>
							@else
							<tr>
								<td>{{ $item->type }}</td>
								<td class="price">{{ $item->buy }}</td>
								<td class="price">{{ $item->sell }}</td>
								<td>{{ date('H:i:s d/m/Y', strtotime($item->updated_at)) }}</td>
							</tr>
							@endif
						@endforeach
					</table>
					<br>
				<p class="origin" style="text-align: right;">Nguồn: Tập đoàn Vàng Bạc Đá Quý PNJ</p>
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
			@include('client.includes.news_random')
		</div>
		<div class="col-lg-3 right">
			@include('client.includes.oil_sidebar')
			@include('client.includes.new_news')
		</div>
	</div>
</div>
@endsection