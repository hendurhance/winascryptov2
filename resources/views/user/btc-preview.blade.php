@extends('layouts.user-frontend.user-dashboard')

@section('content')
@include('layouts.breadcam')
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
                            <div class="panel panel-info panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>
                                </div>
                                <!-- panel body -->
                                <div class="panel-body">

                                    <h4 style="text-align: center;"> SEND EXACTLY <strong>{{ $usd }} BTC </strong> TO <strong>{{ $add }}</strong><br>
                                        {!! $code !!} <br>
                                        <strong>SCAN TO SEND</strong> <br><br>
                                        <strong style="color: red;">NB: 3 Confirmation required to Credited your Account</strong>
                                    </h4>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->

    </div>
</div>
@endsection
