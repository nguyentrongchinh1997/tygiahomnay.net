@extends('client.layouts.index')

@section('content')
<div class="row">
	<div class="col-lg-9 bank-left">
		<h1 class="h1">
			Biểu đồ giá dầu thô thế giới
		</h1>
		<h2 class="h2">
			Crude Oil (Brent) - UKOIL
		</h2><br>
		<iframe src="https://s.tradingview.com/widgetembed/?frameElementId=tradingview_fc42e&symbol=TVC%3AUKOIL&interval=1&symboledit=1&saveimage=1&toolbarbg=f1f3f6&studies=%5B%5D&hideideas=1&theme=White&style=1&timezone=Asia%2FBangkok&studies_overrides=%7B%7D&overrides=%7B%7D&enabled_features=%5B%5D&disabled_features=%5B%5D&locale=vi_VN&referral_id=1713&utm_source=webgia.com&utm_medium=widget&utm_campaign=chart&utm_term=TVC%3AUKOIL"></iframe>
		<h2 style="margin-top: 20px" class="h2">
			Crude Oil (WTI) - USOIL
		</h2>
		<br>
		<iframe src="https://s.tradingview.com/widgetembed/?frameElementId=tradingview_1e92e&symbol=TVC%3AUSOIL&interval=1&symboledit=1&saveimage=1&toolbarbg=f1f3f6&studies=%5B%5D&hideideas=1&theme=White&style=1&timezone=Asia%2FBangkok&studies_overrides=%7B%7D&overrides=%7B%7D&enabled_features=%5B%5D&disabled_features=%5B%5D&locale=vi&referral_id=1713&utm_source=webgia.com&utm_medium=widget&utm_campaign=chart&utm_term=TVC%3AUSOIL"></iframe>
	</div>
	<div class="col-lg-3">

	</div>
</div>
@endsection