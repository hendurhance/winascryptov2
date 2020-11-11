@extends('layouts.user-frontend.user-dashboard')
@section('content')
	
	<section>
		{!!$send_pay_request!!}
	</section>
	

@endsection
@section('script')
   
        <script type="text/javascript">

            $(document).ready(function(){
            	$( "body" ).contextmenu(function() {
				  alert( "Right Click Not Allow!" );
				});
       			$("#pament_form" ).submit();


            });

        </script>

@endsection