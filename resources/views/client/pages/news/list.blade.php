@extends('client.layouts.index')

@section('title', 'Tin tức tài chính ngân hàng, giá vàng')
@section('keywords', 'giá vàng, tin tức, lãi suất ngân hàng')
@section('description', "Cập nhật tin tức tài chính ngân hàng, giá vàng mới nhất")

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
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-lg-9">
					<h2 style="font-size: 20px">
						<a id="news" href="{{ route('client.news') }}">
							TIN TỨC
						</a>
					</h2>
					<br>
					<div class="row" style="margin: 0px -15px">
						@foreach ($newsList as $news)
							<div class="col-md-6 col-lg-6 news-list">
								<div class="row">
									<div class="col-6 col-sm-6 col-md-5 col-lg-4" style="padding-left: 0px">
										<a title="{{$news->title}}" href="{{route('client.news.detail', ['id' => $news->id, 'title' => $news->slug])}}">
											<img alt="{{$news->image}}" src='{{asset("upload/news/$news->image")}}' width="100%">
										</a>
									</div>
									<div class="col-6 col-sm-6 col-md-7 col-lg-8">
										<a title="{{$news->title}}" href="{{route('client.news.detail', ['id' => $news->id, 'title' => $news->slug])}}" class="news-title">
											{{ $news->title }}
										</a>
										{{-- <p class="news-time">
											{{ date('d/m/Y', strtotime($news->created_at)) }}
										</p> --}}
									</div>
								</div>
								<hr>
							</div>	
						@endforeach
						<div class="col-lg-12">
							{{ $newsList->links() }}
						</div>
					</div>
				</div>	
				<div class="col-md-3 col-lg-3 right">
					@include('client.includes.oil_sidebar')
					@include('client.includes.usd_sidebar')
				</div>
			</div>
		</div>
	</div>
@endsection