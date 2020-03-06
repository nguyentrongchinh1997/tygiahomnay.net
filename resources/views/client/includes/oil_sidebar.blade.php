<table>
	<tr style="background: #f5f5f5">
		<td colspan="3" style="text-align: center;">
			<i class="fas fa-filter"></i> Giá bán lẻ xăng dầu
		</td>
	</tr>
	<tr>
		<td style="color: #AA6708; font-weight: bold;">Sản phẩm</td>
		<td style="color: #AA6708; font-weight: bold;">Vùng 1</td>
		<td style="color: #AA6708; font-weight: bold;">Vùng 2</td>
	</tr>
	@foreach($oils as $oil)
		<tr>
			<td>
				{{ $oil->oil_name }}
			</td>
			<td>
				{{ $oil->price_1 }}
			</td>
			<td>
				{{ $oil->price_2 }}
			</td>
		</tr>
	@endforeach
	<tr>
		<td style="text-align: right; color: gray" colspan="3">
			Cập nhật lúc {{ date('H:i:s d/m/Y', strtotime($dateOil)) }}
		</td>
	</tr>
</table>
<img src="https://safedownload.net/images/qc_vultr_doc.jpg" style="margin: 30px 0px; width: 100%">
