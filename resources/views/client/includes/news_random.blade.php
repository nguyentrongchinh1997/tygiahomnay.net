<br>
<h2 style="font-size: 20px">
	<a id="news" href="#">
		Tin liên quan
	</a>
</h2>
<br>
<div class="row" style="margin: 0px -15px">
@foreach ($newsRandomShare as $newsRandomShareItem)
	
		<div class="col-md-6 col-lg-6 news-list">
			<div class="row">
				<div class="col-6 col-sm-6 col-md-5 col-lg-4" style="padding-left: 0px">
					<a title="{{ $newsRandomShareItem->title }}" href="{{route('client.news.detail', ['id' => $newsRandomShareItem->id, 'title' => $newsRandomShareItem->slug])}}">
						<img alt="{{ $newsRandomShareItem->image }}" src='{{asset("upload/news/$newsRandomShareItem->image")}}' width="100%">
					</a>
				</div>
				<div class="col-6 col-sm-6 col-md-7 col-lg-8">
					<a title="{{ $newsRandomShareItem->title }}" href="{{route('client.news.detail', ['id' => $newsRandomShareItem->id, 'title' => $newsRandomShareItem->slug])}}" class="news-title">
						{{ $newsRandomShareItem->title }}
					</a>
				</div>
			</div>
			<hr>
		</div>	
	
@endforeach
</div>