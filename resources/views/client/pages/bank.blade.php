@extends('client.layouts.index')

@section('title', 'Tỉ giá ngân hàng ' . $bank->name . ' - ' . $bank->name_vi)
@section('keywords', 'Tỷ giá ngân hàng ' . $bank->name . ', tỷ giá ngày hôm này, tỷ giá đô la, tỷ giá ngân hàng ' . $bank->name . ' hôm nay, tỷ giá ngoại tệ, ngoại tệ, đô úc, đô canada, franc thụy sĩ, krone đan mạch, đô la hồng kông, bạt thái lan, bảng anh, đồng yên nhật, tiền thái, tỷ giá nga, tỷ giá ả rập, won hàn quốc, tiền malaysia, tỷ giá euro, tỷ giá canada')
@section('description', "Cập nhật tỷ giá ngoại tệ ngân hàng $bank->name mới nhất hôm nay")

@section('content')
<div class="row list-category">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul>
					@foreach ($banks as $bankItem)
							<li style="@if($bankItem->name == $bankName){{'background: #e1e1e1'}}@endif">
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
		<div class="col-lg-9 bank-left">
			<h1 class="h1">
				Tỷ giá ngoại tệ ngân hàng <span style="text-transform: capitalize;">{{ $bank->name }}</span> mới nhất lúc {{ date('d/m/Y', strtotime($date))}}
			</h1>
			<p>
				Bảng tỷ giá ngoại tệ ngân hàng <span style="text-transform: capitalize;">{{ $bank->name }}</span> được cập nhật mới nhất vào lúc <b>{{ date('H:i:s d/m/Y', strtotime($updated_at)) }}</b>
			</p>
			<br>
			<form method="GET" action="{{ route('client.bank', ['bank' => $bank->name]) }}">
				<p id="datepicker">
					@if ($check > 0)
						<a href="{{ route('client.bank.export', ['date' => $date, 'bankId' => $bank->id]) }}">
							<i class="far fa-file-excel"></i> Xuất excel
						</a>
					@endif
					<input autocomplete="off" name="date" value="{{ $date }}" id="datepicker" class="datepicker">
					<button type="submit">Tra cứu</button>
				</p>
			</form>
			<div class="row data-table">
				@if ($check > 0)
					<table>
						<tr>
							<th rowspan="2">Ngoại tệ</th>
							<th rowspan="2">Tên ngoại tệ</th>
							<th colspan="2" style="text-align: center;">
								Mua
							</th>
							<th colspan="2" style="text-align: center;">
								Bán
							</th>
						</tr>
						<tr>
							<th>Tiền mặt</th>
							<th>Chuyển khoản</th>
							<th>Tiền mặt</th>
							<th>Chuyển khoản</th>
						</tr>
						@foreach ($exchangeRate as $exchangeRateItem)
							<tr>
								<td>
									@php
										$image = $exchangeRateItem->currencyName->image;
									@endphp
									<a style="color: #7596c8; font-weight: bold; text-decoration: none;" href="{{ route('client.currency', ['name' => $exchangeRateItem->currencyName->currency_code]) }}">
										<img src='{{ asset("upload/lang/$image") }}'>
										{{ $exchangeRateItem->currencyName->currency_code }}
									</a>
									
								</td>
								<td>
									{{ $exchangeRateItem->currencyName->name }}
								</td>
								<td style="text-align: right;">
									{{ format($exchangeRateItem->buy) }}<br>
								</td>
								<td style="text-align: right;">
									{{ format($exchangeRateItem->transfer) }}
									
								</td>
								<td style="text-align: right;">
									{{ format($exchangeRateItem->sell) }}
								</td>
								<td style="text-align: right;">
									{{ format($exchangeRateItem->sell_transfer) }}
								</td>
							</tr>
						@endforeach
					</table>
			
				<p class="origin" style="text-align: right;">Nguồn: {{ $bank->name_vi }}</p>
				@else
					<div class="alert alert-warning">
						Xin lỗi, chắc có chút nhầm lẫn nho nhỏ :(<br>
						Ngày <b>{{ $date }}</b>, hệ thống chúng tôi không thể dự báo được tỷ giá cho ngày này.<br>
						Bạn có thể tra cứu tỷ giá <b>{{ $bank->name }}</b> ở ô bên trên.
					</div>
				@endif
			</div>
			<hr>
			<div class="info">
				{!! $bank->info !!}
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