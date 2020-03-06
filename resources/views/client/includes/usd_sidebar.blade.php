<img src="https://safedownload.net/images/thi_thu_toeic.jpg" style="margin: 30px 0px; width: 100%">
<table>
	<tr style="background: #f5f5f5">
		<td colspan="3" style="text-align: center;">
			<i class="fas fa-dollar-sign"></i> Tỷ giá USD
		</td>
	</tr>
	<tr>
		<td style="color: #AA6708; font-weight: bold;">NH</td>
		<td style="color: #AA6708; font-weight: bold;">Mua</td>
		<td style="color: #AA6708; font-weight: bold;">Bán</td>
	</tr>
	@foreach($usds as $usd)
		<tr>
			<td style="text-transform: capitalize;">
				<a style="color: #7596c8" href="{{ route('client.bank', ['name' => $usd->bank->name]) }}">
					{{ $usd->bank->name }}
				</a>
			</td>
			<td>
				{{ format($usd->buy) }}
			</td>
			<td>
				{{ format($usd->sell) }}
			</td>
		</tr>
	@endforeach
	<tr>
		<td style="text-align: right; color: gray" colspan="4">
			Cập nhật lúc {{ date('H:i:s d/m/Y', strtotime($reccent_day_sidebar->updated_at)) }}
		</td>
	</tr>
</table>
<img src="https://safedownload.net/images/qc_vultr_doc.jpg" style="margin: 30px 0px; width: 100%">
