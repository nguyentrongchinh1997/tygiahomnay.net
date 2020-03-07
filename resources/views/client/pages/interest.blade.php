@extends('client.layouts.index')

@section('title', 'Lãi suất ngân hàng')
@section('description', 'Danh sách lãi suất các ngân hàng hàng đầu Việt Nam, lãi suất ngân hàng Agribank, Vietcombank, Techcombank, Sacombank, BIDV, Tpbank, Vietinbank ..., lai suat tien gui, cho vay, lãi suất gửi tiết kiệm, lãi suất cho vay.')

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
		<div class="col-lg-9 bank-left">
			<h1 class="h1">
				Lãi suất ngân hàng
			</h1>
			<p>
				Bảng so sánh lãi suất ngân hàng cập nhật mới nhất ngày hôm nay - <b>{{ date('d/m/Y') }}</b>
			</p>
			<div class="data-table-interest" style="overflow-x: auto;">
				<table>
					<tr>
						<th rowspan="2">Ngân hàng</th>
						<th style="text-align: center;" colspan="10">Kỳ hạn: Tháng - Lãi suất: <span style="color: #0066b3">%/năm</span></th>
					</tr>
					<tr>
						<th>
							KKH
						</th>
						<th>
							1 tháng
						</th>
						<th>
							2 tháng
						</th>
						<th>
							3 tháng
						</th>
						<th>
							6 tháng
						</th>
						<th>
							9 tháng
						</th>
						<th>
							12 tháng
						</th>
						<th>
							18 tháng
						</th>
						<th>
							24 tháng
						</th>
						<th>
							36 tháng
						</th>
					</tr>
					@foreach($banks as $bankItem)
						<tr>
							<th style="text-transform: capitalize;">
								{{ $bankItem->name }}
							</th>
							@foreach ($bankItem->interest as $interest)
								<td style="text-align: right;">
									{{ $interest->percent }}
								</td>
							@endforeach
						</tr>
					@endforeach
				</table>
			</div><br>
		</div>
		<div class="col-lg-3 right">
			@include('client.includes.oil_sidebar')
		</div>
	</div>
</div>
@endsection