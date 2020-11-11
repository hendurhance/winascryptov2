@extends('layouts.user-frontend.user-dashboard')

@section('content')
    
@include('layouts.breadcam')

<div class="content_padding">
    <div class="container user-dashboard-body">
    
   <div class="row">
            @foreach($method as $p)

                <div class="col-sm-4 text-center">
                    <div class="panel panel-green panel-pricing">
                        <div class="panel-heading">
                            <h3 style="font-size: 28px; color: #ffffff"><b>{{ $p->name }}</b></h3>
                        </div>
                        <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                            <img class="" style="width: 35%;border-radius: 5px" src="{{ asset('assets/images') }}/{{ $p->image }}" alt="">
                        </div>
                        <ul style='font-size: 15px;' class="list-group text-center bold">
                            <li class="list-group-item">Minimum - {!! $p->withdraw_min !!} {{ $basic->currency }} </li>
                            <li class="list-group-item">Maximum - {!! $p->withdraw_max !!} {{ $basic->currency }} </li>
                            <li class="list-group-item"> Charge - {{ $p->fix }} + {{ $p->percent }}<i class="fa fa-percent"></i> {{ $basic->currency }}</li>
                            <li class="list-group-item">Processing Time - {!! $p->duration !!} Days </li>
                        </ul>
                        <div class="panel-footer" style="overflow: hidden">
                            <div class="col-sm-12">
                                <a href="javascript:;" class="btn btn-primary btn-block" @if($basic->withdraw_status == 0) disabled @else onclick="jQuery('#modal-{{ $p->id }}').modal('show');" @endif class="btn btn-info btn-block btn-icon btn-lg bold icon-left"> Withdraw Now</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
    </div><!-- ROW-->

    @foreach($method as $b)


        <div class="modal fade" id="modal-{{ $b->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></i> <strong>Withdraw via {{ $b->name }}</strong> </h4>
                    </div>
                    {{ Form::open() }}
                    <input type="hidden" name="method_id" value="{{ $b->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <span style="margin-bottom: 10px;"><code>Withdraw Charge : ({{ $b->fix }} + {{ $b->percent }}%) - {{ $basic->currency }}</code></span>
                                        <div class="input-group" style="margin-top: 10px;margin-bottom: 10px;">
                                            <input type="number" value="" id="amount" name="amount" class="form-control" required placeholder="Withdraw Amount" />
                                            <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary btn-block"></i> Withdraw Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    @endforeach


    </div>
</div>
@endsection