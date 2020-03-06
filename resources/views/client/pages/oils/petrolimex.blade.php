@extends('client.layouts.index')

@section('title', 'Giá xăng dầu - Lịch sử giá xăng dầu bán lẻ Petrolimex - Tập đoàn Xăng dầu Việt Nam')
@section('keywords', 'giá xăng dầu, xăng dầu, xangdau, giá xăng, giá dầu, giá xăng trong nước, giá xăng việt nam, giá xăng petro, xăng hôm nay, dầu hôm nay, xăng mới nhất, dầu mới nhất, Petrolimex, dầu khí, xăng RON 95, xăng a95, xăng RON 92, xăng a92, xăng xe máy, xăng xe hơi, xăng oto, xăng xe tải, xăng E5 RON 92, xăng sinh học, dầu DO 0,05S, dầu hỏa, dầu lửa, giá bán lẻ xăng dầu, xăng tăng, xăng giảm, dầu điêzen, dầu mazút')
@section('description', 'Lịch sử giá xăng dầu bán lẻ của tập đoàn Petrolimex. Giaá Xăng RON 95, Xăng RON 92, Xăng E5 RON 92, Dầu DO 0,05S, Dầu hỏa, Dầu lửa, Giá bán lẻ xăng dầu, xăng tăng, xăng giảm')

@section('content')
	<div class="row list-category">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul>
						<li style="@if($slug == config('config.oil.petrolimex')){{'background: #e1e1e1'}}@endif">
							<a href="{{ route('client.oil') }}">
								Petrolimex
							</a>
						</li>
						<li style="@if($slug == config('config.oil.dau-tho')){{'background: #e1e1e1'}}@endif">
							<a href="{{ route('client.crude') }}">
								Dầu thô
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
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
				<div class="info">
					<h3>
						Vùng I, Vùng II giá bán lẻ xăng dầu là gì?
					</h3>
					<p>
						Vào tháng 6/2015, tập đoàn Xăng dầu Petrolimex ban hành văn bản quy định danh mục địa bàn vùng 1 và 2 trong hoạt động kinh doanh xăng dầu. 44 tỉnh/ thành phố và tất cả các đảo của Việt Nam được phân vào vùng 2 khi thiết lập giá bán lẻ. Theo đó, 44 tỉnh/thành phố và các đảo Việt Nam sẽ áp dụng mức giá xăng riêng cho vùng 2.
					</p>
					<p>
						Mức giá này cao hơn giá của vùng 1 (bao gồm các tỉnh thành phố còn lại, trong đó có Hà Nội, Hải Phòng, Quảng Ninh, Đà Nẵng, TP HCM…), và chênh với giá cơ sở tối đa 2%. xăng dầu, với mức chênh lệch so giá cơ sở tối đa là 2%.
					</p>
					<h3>Các tỉnh được gộp vào vùng 2 bao gồm:</h3>
					<p>
						Vùng 2: bao gồm các tỉnh: Hà Giang, Cao Bằng, Lạng Sơn, Bắc Kạn, Lào Cai, Yên Bái, Tuyên Quang, Điện Biên, Lai Châu, Sơn La, Hòa Bình, Lâm Đồng, Gia Lai, Kon Tum, Đắc Nông, Đắc Lắc, Thái nguyên, Bắc Giang, Phú Thị, Vĩnh Phúc, Bắc Ninh, Thái Bình, Nam Định, Hà Nam, Ninh Bình, Thanh Hóa, Nghệ An, Hà Tĩnh, Quảng Bình, Quảng Nam, Bình Định, Phú Yên, Khánh Hòa, Ninh Thuận, Bình Phước, An Giang, Bạc Liêu, Cà Mau, Quảng Trị, Thừa Thiên Huế, Bình Thuận, Đồng Tháp, Sóc Trăng, Hậu Giang. Tất cả các đảo thuộc Việt Nam.
					</p>
					<h3>
						Các tỉnh được gộp vào vùng 1:
					</h3>
					<p>
						Các tỉnh còn lại.
					</p>
				</div>
			</div>
			<div class="col-lg-3 right">
				@include('client.includes.usd_sidebar')
			</div>
		</div>
	</div>
@endsection