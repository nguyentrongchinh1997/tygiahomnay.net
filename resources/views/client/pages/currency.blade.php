@extends('client.layouts.index')

@section('content')
<div class="row">
	<div class="col-lg-9 bank-left">
		<h1 class="h1">
			Bảng so sánh tỷ giá {{ $currency->name }} ({{ $currencyName }}) tại các ngân hàng
		</h1>
		<p>Ngày {{ $date }}</p>
		<table>
			<tr>
				<th>Ngân hàng</th>
				<th>Mua</th>
				<th>Mua chuyển khoản</th>
				<th>Bán</th>
				<th>Bán chuyển khoản</th>
			</tr>
			@foreach($exchangeRate as $exchangeRateItem)
				<tr>
					<td style="text-transform: capitalize;">
						<a style="color: #7596c8; font-weight: bold; text-decoration: none;" href="{{ route('client.bank', ['bank' => $exchangeRateItem->bank->name]) }}">
							{{ $exchangeRateItem->bank->name }}
						</a>
					</td>
					<td class="price">
						{{ format($exchangeRateItem->buy) }}
					</td>
					<td class="price">
						{{ format($exchangeRateItem->transfer) }}
					</td>
					<td class="price">
						{{ format($exchangeRateItem->sell) }}
					</td>
					<td class="price">
						{{ format($exchangeRateItem->sell_transfer) }}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection