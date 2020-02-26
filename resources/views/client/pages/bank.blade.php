@extends('client.layouts.index')

@section('content')
<div class="row">
	<div class="col-lg-9 bank-left">
		@if ($check > 0)
			<h1 class="h1">
				Tỷ giá ngoại tệ ngân hàng <span style="text-transform: capitalize;">{{ $bank->name }}</span> mới nhất lúc 
			</h1>
			<p>
				Bảng tỷ giá ngoại tệ ngân hàng <span style="text-transform: capitalize;">{{ $bank->name }}</span> được cập nhật mới nhất vào lúc <b>{{ date('H:i:s d/m/Y', strtotime($date->updated_at)) }}</b>
			</p>
		@endif
		
		<form method="GET" action="{{ route('client.bank', ['bank' => $bank->name]) }}">
			<p id="datepicker">
				<input autocomplete="off" name="date" value="@if($check > 0){{ $date->date }}@endif" id="datepicker" class="datepicker">
				<button>Tra cứu</button>
			</p>
		</form>
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
		@else
			<i>
				Đang cập nhật
			</i>
		@endif
		<br>
		<p class="origin" style="text-align: right;">Nguồn: {{ $bank->name_vi }}</p>
	</div>
	<div class="col-lg-3">
		d
</div>
</div>

@endsection