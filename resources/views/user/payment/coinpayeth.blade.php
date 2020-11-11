@extends('layouts.user-frontend.user-dashboard')
@section('content')
<div class="content_padding">
	<div class="container user-dashboard-body">  
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light bordered">
					<div class="portlet-title">
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-8 col-sm-12 col-md-offset-2">
								<div class="panel panel-default panel-shadow" data-collapsed="0">

									<div class="panel-heading">
										<div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>
									</div>
			<div class="panel-body text-center">
				<h6> PLEASE SEND EXACTLY <span style="color: green"> {{ $bcoin }}</span> ETH</h6>
				<h5>TO <span style="color: green"> {{ $wallet}}</span></h5>
				{!! $qrurl !!}
				<h4 style="font-weight:bold;">SCAN TO SEND</h4>						
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection