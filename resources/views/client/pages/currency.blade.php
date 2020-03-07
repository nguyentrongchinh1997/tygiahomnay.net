@extends('client.layouts.index')

@section('title', 'Tỷ giá ' . $currency->currency_code . ' - ' . $currency->name . ' mới nhất ngày hôm nay')
@section('keywords', "so sánh $currency->currency_code, tỷ giá $currency->currency_code, tỷ giá 1 $currency->currency_code, so sánh tỷ giá $currency->currency_code mới nhất")
@section('description', "Cập nhật so sánh  tỷ giá $currency->currency_code mới nhất ngày hôm nay của tất cả ngân hàng Việt Nam. So sánh tỷ giá $currency->name mua tiền mặt, chuyển khoản, bán tiền mặt, bán chuyển khoản")

@section('content')
<div class="row list-category">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul>
					@foreach ($currencyList as $currencyItem)
							<li style="@if($currencyName == $currencyItem->currency_code){{'background: #e1e1e1'}}@endif">
								<a href="{{ route('client.currency', ['name' => $currencyItem->currency_code]) }}">
									{{ $currencyItem->currency_code }}
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
				Bảng so sánh tỷ giá {{ $currency->name }} ({{ $currencyName }}) tại các ngân hàng
			</h1>
			<p style="font-size: 14px; color: #727272">Ngày {{ $date }}</p>
			<div class="data-table">
				<table>
					<tr>
						<th>Ngân hàng</th>
						<th>Mua</th>
						<th>Mua chuyển khoản</th>
						<th>Bán</th>
						<th>Bán chuyển khoản</th>
					</tr>
					@foreach ($banks as $bank)
						<tr>
							<td style="text-transform: capitalize;">
								<a style="color: #7596c8; font-weight: bold; text-decoration: none;" href="{{ route('client.bank', ['bank' => $bank->name]) }}">
									{{ $bank->name }}
								</a>
							</td>
							<td class="text-right">
								@if(!empty(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)))
									{{ format(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)->buy) }}
								@else
									<i>-</i>
								@endif
							</td>
							<td class="text-right">
								@if(!empty(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)))
									{{ format(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)->transfer) }}
								@else
									<i>-</i>
								@endif
							</td>
							<td class="text-right">
								@if(!empty(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)))
									{{ format(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)->sell) }}
								@else
									<i>-</i>
								@endif
							</td>
							<td class="text-right">
								@if(!empty(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)))
									{{ format(\App\Helper\Helper::getExchangeRate($date, $bank->id, $currency->id)->buy_transfer) }}
								@else
									<i>-</i>
								@endif
							</td>
						</tr>
					@endforeach
					
				</table>
			</div>
			<br>
		</div>
		<div class="col-lg-3 right">
			@include('client.includes.oil_sidebar')
		</div>
	</div>
</div>
@endsection