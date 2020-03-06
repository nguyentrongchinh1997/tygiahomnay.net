<table>
	<tr>
		<td style="text-align: center; font-size: 25px; font-weight: bold;" colspan="7">
			Ngân hàng {{ $bank->name }}
		</td>
	</tr>
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
		<th>Ngày</th>
	</tr>

	@foreach ($exchangeRate as $exchangeRateItem)
		<tr>
			<td>
				{{ $exchangeRateItem->currencyName->currency_code }}
			</td>
			<td>
				{{ $exchangeRateItem->currencyName->name }}
			</td>
			<td style="text-align: right;">
				{{ format($exchangeRateItem->buy) }}
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
			<td>
				{{ $exchangeRateItem->date }}
			</td>
		</tr>
	@endforeach
</table>