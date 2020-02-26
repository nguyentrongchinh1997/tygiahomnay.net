@extends('client.layouts.index')

@section('content')
<div class="row">
	<div class="col-lg-9 bank-left">
		<h1 class="h1">
			Giá bán lẻ xăng dầu Petrolimex mới nhất ngày {{ $date }}
		</h1>
		<p>
			Bảng tỷ giá ngoại tệ ngân hàng <span style="text-transform: capitalize;"></span> được cập nhật mới nhất vào ngày {{ $date }}<b></b>
		</p>

		<form method="GET" action="{{ route('client.oil') }}">
			<p id="datepicker">
				<input autocomplete="off" value="{{ $date }}" name="date" value="" id="datepicker" class="datepicker">
				<button>Tra cứu</button>
			</p>
		</form>
		@if ($check > 0)
			<table>
				<tr>
					<th>Sản phẩm</th>
					<th>Vùng 1</th>
					<th>Vùng 2</th>
				</tr>
				@foreach ($oils as $oil)
				<tr>
					<td>
						<a href="">
							{{ $oil->oil_name }}
						</a>
					</td>
					<td>
						{{ $oil->price_1 }}
					</td>
					<td>
						{{ $oil->price_2 }}
					</td>
				</tr>
				@endforeach
			</table>
		@else
			<p>Xin lỗi, chắc có chút nhầm lẫn nho nhỏ :(</p>
			<p>Hôm nay là ngày <b>{{ $date }}</b>, hệ thống chúng tôi không thể dự báo được giá dầu Petrolimex .</p>
			<p>Bạn có thể tra cứu giá dầu Petrolimex ở ô bên trên.</p>
		@endif
	</div>
	<div class="col-lg-3">

	</div>
</div>
@endsection