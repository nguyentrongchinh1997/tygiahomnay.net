<br>
<h2 style="font-size: 20px">
	<a id="news" href="#">
		Tin mới
	</a>
</h2>
<br>
@foreach ($newNews as $newsSidebar)
	<div class="row news-sidebar" style="margin: 0px -15px">
		<div class="col-5 col-sm-5 col-md-5 col-lg-5">
			<a href="{{ route('client.news.detail', ['id' => $newsSidebar->id, 'slug' => $newsSidebar->slug]) }}">
				<img src='{{asset("upload/news/$newsSidebar->image")}}' width="100%">
			</a>
			
		</div>
		<div class="col-7 col-sm-7 col-md-7 col-lg-7" style="margin-top: -6px">
			<a href="{{ route('client.news.detail', ['id' => $newsSidebar->id, 'slug' => $newsSidebar->slug]) }}">
				{{ $newsSidebar->title }}
			</a>
		</div>
	</div>
	<hr>
@endforeach
