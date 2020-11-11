@extends('layouts.user-frontend.user-dashboard')

@section('content')
@include('layouts.breadcam')
<div class="content_padding">
    <div class="container user-dashboard-body">  
	<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Confirm Deposit</h3>
		</div>
		<div class="panel-body">

			<div  class="col-md-8 col-md-offset-2 text-center">

				<h1><i class="fa fa-usd"></i>{{$amon}} 
						<i class="fa fa-exchange"></i> <i class="fa fa-bitcoin"></i>{{ $bcoin }}</h1>

			
			<b style="color: red; margin-top: 15px;"> Minimum 3 Confirmation Required to Credited Your Account.<br/>(It May Take Upto 2 to 24 Hours)</b>
			<br/>
			<span style="color:red;font-size:15px;">Note: Deposit charge included with mention amount</span>
			<p style="margin-top: 15px;">{!! $form !!}</p>
			</div>
			

		</div>
	</div>
	</div>
	</div>
		</div>
	</div>
@endsection