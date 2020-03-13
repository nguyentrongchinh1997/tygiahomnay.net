@extends('client.layouts.index')

@section('title', 'Giá vàng DOJI Việt Nam - Tập đoàn Vàng bạc Đá quý DOJI')

@section('description', 'Giá vàng DOJI mới nhất hôm nay, giaá vàng doji 1 lượng lẻ, doji buôn, vàng miếng, nhẫn doji, doji trang sức, nhẫn cưới, vàng nguyên liệu 99.99, vàng bốn số 9, vàng nguyên liệu 99.9, nhẫn PLPT, kim thần tài, lộc phát tài, nhẫn htv, nữ trang 99.99, nữ trang bốn số 9, nữ trang 99.9, nữ trang 99, nữ trang 75, nữ trang 58.3, nữ trang 41.7, doji hà nội, doji hn, doji đà nẵng, doji hcm, doji hồ chí minh')

@section('keywords', 'oji, vàng miếng, giá vàng doji, giá vàng doji hôm nay, giá vàng sjc, giá vàng 9999, nhẫn tròn trơn, kim thần tài, lộc phát tài, nhẫn htv, vàng trang sức, vàng bản vị, vàng thỏi, vàng nén, vàng doji, vàng thị trường, vàng 750, vàng 700, vàng 16.8k, vàng 680, vàng 16.3k, vàng 585, vàng 14k, vàng 37.5, vàng 9k,vàng nguyên liệu doji, vàng nguyên liệu thị trường')

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
				Giá vàng DOJI Việt Nam
			</h1>
			<p>
				Giá vàng SJC Việt Nam cập nhất <b>mới nhất vào lúc {{ date('H:i:s d/m/Y', strtotime($recent_day_detail)) }}</b>
			</p>
			<br>
			<form method="GET" action="{{ url()->current() }}">
				<p id="datepicker" style="text-align: center;">
					<input value="{{ date('d-m-Y', strtotime($recentDay)) }}" autocomplete="off" name="date" value="" id="datepicker" class="datepicker">
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
							<th rowspan="2">
								Loại
							</th>
							<th colspan="2" style="text-align: center;">
								Hà Nội
							</th>
							<th colspan="2" style="text-align: center;">
								Đà Nẵng
							</th>
							<th colspan="2" style="text-align: center;">
								Tp.Hồ Chính Minh
							</th>
						</tr>
						<tr>
							<th>Mua vào</th>
							<th>Bán ra</th>
							<th>Mua vào</th>
							<th>Bán ra</th>
							<th>Mua vào</th>
							<th>Bán ra</th>
						</tr>
						@foreach ($goldDetails as $slug => $item)
							@php
								$row = \App\Helper\Helper::type($goldId, $slug, $recentDay);
							@endphp
							<tr>
								<td>
									{{ $row->type }}
								</td>
								<td class="price">
									{{ \App\Helper\Helper::getPrice($goldId, $recentDay, $slug, config('config.city.hn'))->buy }}
								</td>
								<td class="price">
									{{ \App\Helper\Helper::getPrice($goldId, $recentDay, $slug, config('config.city.hn'))->sell }}
								</td>
								<td class="price">
									{{ \App\Helper\Helper::getPrice($goldId, $recentDay, $slug, config('config.city.dn'))->buy }}
								</td>
								<td class="price">
									{{ \App\Helper\Helper::getPrice($goldId, $recentDay, $slug, config('config.city.hn'))->sell }}
								</td>
								<td class="price">
									{{ \App\Helper\Helper::getPrice($goldId, $recentDay, $slug, config('config.city.hcm'))->buy }}
								</td>
								<td class="price">
									{{ \App\Helper\Helper::getPrice($goldId, $recentDay, $slug, config('config.city.hcm'))->sell }}
								</td>
							</tr>
						@endforeach
					</table>
					<br>
					<p class="origin" style="text-align: right;">Nguồn: Tập đoàn Vàng Bạc Đá Quý DOJI</p>
				@else
					<div class="alert alert-warning">
						Xin lỗi, chắc có chút nhầm lẫn nho nhỏ :(<br>
						Ngày <b>{{ $recentDay }}</b>, hệ thống chúng tôi không thể dự báo được tỷ giá vàng cho ngày này.<br>
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