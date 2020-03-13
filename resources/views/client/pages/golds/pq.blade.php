@extends('client.layouts.index')

@section('title', 'Giá vàng Phú Quý Việt Nam')

@section('description', 'Cập nhật giá vàng SJC Phú Quý mới nhất hôm nay. Giá vàng miếng, vàng SJC 1 lượng, vàng 24k, vàng 9999, nhẫn tròn trơn, vàng trang sức, vàng nhẫn, vàng bán buôn. Giaá vàng Phú Quý Hà Nội, Ninh Bình, Vĩnh Yên.')

@section('keywords', 'giá vàng phú quý, phu quy, vàng phú quý, giá vàng, giá vàng sjc, phu quy sjc, vàng miếng, vàng 1 lượng, vàng 24k, vang 9999, vàng 12 con giáp, vàng CNG, nhẫn tròn trơn, vàng nhẫn, nhẫn 9999, phú quý bán buôn, vàng giá sỉ, phú quý vàng giá sỉ, phú quý hà nội, phú quý hn, phú quý ninh bình, phú quý vĩnh yên')

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
							<th>
								Loại
							</th>
							<th style="text-align: center;">
								Mua vào
							</th>
							<th style="text-align: center;">
								Bán ra
							</th>
						</tr>
						@foreach($goldDetails as $item)
							@php $k = ++$stt @endphp
							@if ($k == 1 || $k == 4 || $k == 7)
								<tr>
									@if ($item->city_id == config('config.city.hn') || $item->city_id == config('config.city.hcm'))
										@php $rowspan = 3; @endphp
									@elseif($item->city_id == config('config.city.ban-buon'))
										@php $rowspan = 1; @endphp
									@endif
									<th rowspan="{{ $rowspan }}">
											{{ $item->city->name }}
									</th>
									<td>{{ $item->type }}</td>
									<td class="price">
										{{ $item->buy }}
									</td>
									<td class="price">
										{{ $item->sell }}
									</td>
								</tr>
							@else
								<tr>
									<td>{{ $item->type }}</td>
									<td class="price">
										{{ $item->buy }}
									</td>
									<td class="price">
										{{ $item->sell }}
									</td>
								</tr>
							@endif
						@endforeach
					</table>
					<br>
				<p class="origin" style="text-align: right;">Nguồn: Tập đoàn Vàng Bạc Đá Quý Bảo Tín Minh Châu</p>
				@else
					<center>
						<i>Đang cập nhật...</i>
					</center>
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