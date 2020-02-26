@extends('client.layouts.index')

@section('content')
<div class="row">
	<div class="col-lg-9 bank-left">
		<h1 class="h1">
			Giá vàng SJC Việt Nam
		</h1>
		<p>
			Giá vàng SJC Việt Nam cập nhất <b>mới nhất vào lúc - @if ($check > 0){{ date('H:i:s d/m/Y', strtotime($recent_day_detail)) }} @else {{ date('H:i:s') }} {{ $recent_day }}@endif</b>
		</p>
		<br>
		<form method="GET" action="{{ route('client.gold', ['name' => $slug]) }}">
			<p id="datepicker">
				<span style="color: red;float: left; margin-top: 10px; font-style: italic;">Đơn vị: nghìn đồng/lượng</span>
				<input value="{{ $recent_day }}" autocomplete="off" name="date" value="" id="datepicker" class="datepicker">
				<button>Tra cứu</button>
			</p>
		</form>
		@if ($check > 0)
			<table>
				<tr>
					<th></th>
					<th>Loại</th>
					<th>Mua vào</th>
					<th>Bán giá</th>
				</tr>
				@foreach ($goldDetails as $goldItem)
					@php $k = ++$stt @endphp
					@if ($k == 1)
						<tr>
							<th rowspan="8">
								{{ $goldItem->city }}
							</th>
							<td>
								{{ $goldItem->type }}
							</td>
							<td style="text-align: right;">
								{{ $goldItem->buy }}
							</td>
							<td style="text-align: right;">
								{{ $goldItem->sell }}
							</td>
						</tr>
					@elseif ($k > 1 && $k < 9)
						<tr>
							<td>
								{{ $goldItem->type }}
							</td>
							<td style="text-align: right;">
								{{ $goldItem->buy }}
							</td>
							<td style="text-align: right;">
								{{ $goldItem->sell }}
							</td>
						</tr>
					@elseif ($k >= 9)
						<tr>
							<th>
								{{ $goldItem->city }}
							</th>
							<td>
								{{ $goldItem->type }}
							</td>
							<td style="text-align: right;">
								{{ $goldItem->buy }}
							</td>
							<td style="text-align: right;">
								{{ $goldItem->sell }}
							</td>
						</tr>
					@endif
				@endforeach
			</table>
		@else
			<p style="text-align: center; font-style: italic;">
				Đang cập nhật....
			</p>
			
		@endif
	</div>
	<div class="col-lg-3">
		s
	</div>
</div>
@endsection