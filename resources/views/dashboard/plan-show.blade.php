@extends('layouts.dashboard')

@section('style')

@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption uppercase">
                        <strong><i class="fa fa-info-circle"></i> {{ $page_title }}</strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body" style="overflow: hidden">

                    @foreach($plan as $p)

                        <div class="col-sm-3 text-center">
                            <div class="panel panel-primary panel-pricing">
                                <div class="panel-heading">
                                    <h3 style="font-size: 28px;"><b>{{ $p->name }}</b></h3>
                                </div>
                                <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                    <p><strong>{{ $p->minimum }} {{ $basic->currency }} - {{ $p->maximum }} {{ $basic->currency }}</strong></p>
                                </div>
                                <ul style='font-size: 15px;' class="list-group text-center bold">
                                    <li class="list-group-item"><i class="fa fa-check"></i> Commission - {{ $p->percent }} <i class="fa fa-percent"></i> </li>
                                    <li class="list-group-item"><i class="fa fa-check"></i> Repeat - {{ $p->time }} times </li>
                                    <li class="list-group-item"><i class="fa fa-check"></i> Compound - <span class="aaaa">{{ $p->compound->name }}</span></li>
                                    <li class="list-group-item"><span class="aaaa">{{ $p->status == 1 ? "Active" : 'DeActive' }}</span></li>
                                </ul>
                                <div class="panel-footer" style="overflow: hidden">
                                    <div class="col-sm-12">
                                        <a class="btn btn-block btn-primary bold uppercase" href="{{ route('plan-edit',$p->id) }}"><i class="fa fa-edit"></i> Edit plan</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div><!---ROW-->

@endsection
@section('scripts')

@endsection
