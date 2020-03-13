@extends('client.layouts.index')

@section('title', $news->title)
@section('keywords', $news->keyword)
@section('description', $news->description)

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
				<div class="col-lg-9 news-detail">
					<h2 style="font-size: 20px">
						<a id="news" href="{{ route('client.news') }}">
							TIN TỨC
						</a>
					</h2>
					<br>
					<h1 class="news-detail-title" title="{{$news->title}}">{{ $news->title }}</h1>
					<hr style="margin-bottom: 10px">
					<p style="font-size: 14px; color: #727272; margin-bottom: 10px"><i class="far fa-clock"></i> {{ date('H:s', strtotime($news->created_at)) }} | {{ date('d/m/Y', strtotime($news->created_at)) }}</p>
					<hr style="margin-top: 0px">
					<p id="summary">
						{{ $news->description }}
					</p>
					<ul class="news-rand">
						@foreach ($newsRand as $newsRandItem)
						<li>
{{-- 							<span style="color: #777; font-size: 14px; padding-right: 10px">
								{{ date('d-m-Y', strtotime($newsRand->created_at)) }}
							</span> --}}
							<a title="{{$newsRandItem->title}}" href="{{ route('client.news.detail', ['id' => $newsRandItem->id, 'slug' => $newsRandItem->slug]) }}" style="font-weight: bold;padding-left: 25px;">
								{{ $newsRandItem->title }}
							</a>
						</li>
						@endforeach
					</ul>
					<div class="row" style="margin-right: -15px; margin-left: -15px">
						<div class="col-lg-9 content">
							{!! $news->content !!}
							<p>
								<b>Nguồn</b>: <a target="_blank" rel="nofollow" href="{{ $news->origin }}">{{ $news->origin }}</a>
							</p>
						</div>
						<div class="col-lg-3">
							<h2 style="font-size: 20px">
								<a id="news" href="{{ route('client.news') }}">
									Tin xem nhiều
								</a>
							</h2>
							<ul class="news-top">
								@foreach ($newsTopRand as $newsRandItem)
									<a href="{{ route('client.news.detail', ['id' => $newsRandItem->id, 'slug' => $newsRandItem->slug]) }}">
										<li>
											<img src='{{asset("upload/news/$newsRandItem->image")}}' width="100%">
											{{ $newsRandItem->title }}
										</li>
										<hr>
									</a>
								@endforeach
							</ul>
						</div>
					</div>
				</div>	
				<div class="col-lg-3 right">
					@include('client.includes.oil_sidebar')
					@include('client.includes.usd_sidebar')
				</div>
			</div>
		</div>
	</div>
@endsection
