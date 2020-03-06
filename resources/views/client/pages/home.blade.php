@extends('client.layouts.index')

@section('content')
<div class="row list-category">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul>
					@foreach ($banks as $bankItem)
						<li>
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
		<div class="col-12 col-md-8 col-lg-9">
			<h1 class="h1" style="font-size: 20px; font-weight: normal;">Tỷ giá vàng hôm nay <b>{{ date('d/m/Y') }}</b></h1>
			<table class="table">
				<tr>
					<td colspan="3" style="font-weight: bold; text-align: center; font-size: 18px">{{ str_replace('Bạc', '', $title) }}</td>
				</tr>
				<tr>
					<th>Loại</th>
					<th>Mua vào</th>
					<th>Bán ra</th>
				</tr>
				<tr>
					<td>Vàng 99.9</td>
					<td>{{ $buy_99 }}</td>
					<td>{{ $sell_99 }}</td>
				</tr>
				<tr>
					<td>Nhẫn vĩ SDJ</td>
					<td>{{ $buy_sdj }}</td>
					<td>{{ $sell_sdj }}</td>
				</tr>
			</table>
			<br><br>
			<h1 class="h1" style="font-size: 20px; font-weight: normal;">Biểu đồ tỷ giá Euro (EUR) ngân hàng Vietinbank - <b>tháng {{ date('m/Y') }}</b></h1>
			<table style="margin: auto;">
				<tr>
					<td>
						<span style="width: 50px; height: 10px; background: #ff6300; display: block;"></span>
					</td>
					<td style="padding: 0px 10px">
						Bán ra
					</td>
					<td style="padding: 0px 10px 0px 20px">
						<span style="width: 50px; height: 10px; background: #0066b3; display: block;"></span>
					</td>
					<td style="padding: 0px 10px">
						Mua vào
					</td>
				</tr>
			</table>
			<br>
			<div class="row">
				{!! $usersChart->container() !!}
				{!! $usersChart->script() !!}
			</div> 
			<br><br>
			<h1 class="h1" style="font-size: 20px; font-weight: normal;">Tỷ giá Đô La Mỹ (USD) ngày hôm nay - <b>tháng {{ date('d/m/Y') }}</b></h1>
			<div class="row data-table">
			<table class="table">
				<tr style="background: #0066b3; color: #fff">
					<th>
						Ngân hàng
					</th>
					<th>Mua</th>
					<th>Mua CK</th>
					<th>Bán</th>
					<th>Bán CK</th>
				</tr>
				@foreach ($currency as $price)
					<tr>
						<th style="text-transform: capitalize;">
							{{ $price->bank->name }}
						</th>
						<td>
							{{ format($price->buy) }}
						</td>
						<td>
							{{ format($price->transfer) }}
						</td>
						<td>
							{{ format($price->sell) }}
						</td>
						<td>
							{{ format($price->sell_transfer) }}
						</td>
					</tr>
					
				@endforeach
			</table>
			</div>
		</div>
		<div class="col-12 col-md-4 col-lg-3 right">
			@include('client.includes.oil_sidebar')
		</div>
	</div>
</div>
@endsection