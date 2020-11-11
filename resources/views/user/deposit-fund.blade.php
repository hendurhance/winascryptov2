@extends('layouts.user-frontend.user-dashboard')
@section('content')
@include('layouts.breadcam')

<div class="content_padding">
    <div class="container user-dashboard-body text-center">  
    <h3 class="text-uppercase">Payment Methods</h3>


        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">

                    {{$error}}
                </div>
            @endforeach
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissable">

                {{ session()->get('message') }}
            </div>
        @endif
    <hr>
       <div class="row">
            @foreach($gateways as $b)
               
                <div class="col-md-3">
                    <div class="panel panel-default" data-collapsed="0">
                        <!-- panel head -->
                        <div class="panel-heading">
                            <div class="panel-title"><strong>{{ $b->name }}</strong></div>
                        </div>
                        <!-- panel body -->
                        <div class="panel-body">
                            <img class="image-responsive" src="{{ asset('assets/images') }}/{{ $b->image }}" alt="" style="height: 220px; width: 100%;">
                        </div>
                        <div class="panel-footer">
                            <a href="javascript:;" onclick="jQuery('#modal-{{ $b->id }}').modal('show');" class="btn btn-primary btn-block btn-icon icon-left">ADD FUND</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
   </div>
</div>

<!--Modal -->
    @foreach($gateways as $b)

        <div class="modal fade" id="modal-{{ $b->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title bold"><strong>Add Fund via {{ $b->name }}</strong> </h4>
                    </div>
                    {{ Form::open() }}
                    <input type="hidden" name="payment_type" value="{{ $b->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                        <p style="margin-bottom: 10px;"><code>Deposit Charge : ({{ $b->fix }} + {{ $b->percent }}%)  {{ $basic->currency }}</code></p>
                                        @if($b->id < 800)
                                        <p style="margin-bottom: 10px;"><code>Deposit Limit : ({{ $b->minamo }} ~ {{ $b->maxamo }})  {{ $basic->currency }}</code></p>
                                        @else
                                            <p style="margin-bottom: 10px;">Deposit On :</p>
                                            {!!$b->val1!!}
                                        @endif
                                    <div class="col-sm-12">
                                        <div class="input-group" style="margin-top: 10px;margin-bottom: 10px;">
                                            <span class="input-group-addon">&nbsp;<strong>Amount</strong></span>
                                            <input type="number" value="" id="amount" name="amount" class="form-control" required />
                                            <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary btn-block bold uppercase">Add Now!</button>
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
@endsection


@section('script')
    @if (session('message'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Success!", "{{ session('message') }}", "success");

            });

        </script>

    @endif



    @if (session('alert'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "{{ session('alert') }}", "error");

            });

        </script>

    @endif
@endsection
