@extends('layouts.dashboard')

@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><i class="fa fa-bank"></i> {{ $page_title }}</strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body" style="overflow: hidden">

                    <div class="col-sm-3 text-center">
                        <div class="panel panel-primary panel-pricing">
                            <div class="panel-heading">
                                <h3 style="font-size: 28px;"><b>{{ $btc->name }}</b></h3>
                            </div>
                            <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                <img class="" style="width: 35%;border-radius: 5px" src="{{ asset('assets/images') }}/{{ $btc->image }}" alt="">
                            </div>
                            <ul style='font-size: 15px;' class="list-group text-center bold">
                                <li class="list-group-item">{!! $btc->val1  !!}  </li>
                                <li class="list-group-item">Currency - {!! $btc->currency  !!}  </li>
                                <li class="list-group-item">1 {!! $basic->currency  !!} = {{ $btc->rate }} {{ $btc->currency }} </li>
                                <li class="list-group-item"> Fix Charge - {{ $btc->fix }} {{ $basic->currency }}</li>
                                <li class="list-group-item"> Percentage - {{ $btc->percent }}<i class="fa fa-percent"></i></li>
                                <li class="list-group-item"><span class="aaaa">{{ $btc->status == 1 ? "Active" : 'DeActive' }}</span></li>
                            </ul>
                            <div class="panel-footer" style="overflow: hidden">
                                <div class="col-sm-12">
                                    <a class="btn btn-block btn-primary bold uppercase" href="{{ route('btc-manual-method-edit',$btc->id) }}"><i class="fa fa-edit"></i> EDIT </a>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection