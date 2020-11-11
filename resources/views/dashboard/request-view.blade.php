@extends('layouts.dashboard')
@section('style')
    <style>

    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">


            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body" style="overflow: hidden">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="text-center bold">
                            <h3>Transaction ID : #{{ $deposit->transaction_id }}</h3>
                            <h3>Deposit Method : {{ $deposit->bank->name }}</h3>
                            @if($deposit->bank->id == 5)
                                <h3>Send Amount : {{ round($deposit->net_amount / $deposit->bank->rate, $basic->deci) }} - {{ $deposit->bank->currency }}</h3>
                            @else
                                <h3>Send Amount : {{ $deposit->net_amount * $deposit->bank->rate }} - {{ $deposit->bank->currency }}</h3>
                            @endif
                            <h3>Deposit Amount : {{ $deposit->amount }} - {{ $basic->currency }}</h3>
							<h3>Depositor : <a href="{{ route('user-details',$deposit->user_id) }}" class="btn btn-primary"><i class="fa fa-user"></i> {{ $deposit->member->username }}</a></h3>
							<hr>
							<h3>Status : 

									@if($deposit->status == 1)
                                        <span class="label label-primary bold uppercase"><i class="fa fa-check"></i> Approved</span>
                                    @elseif($deposit->status == 2)
                                            <span class="label label-danger bold uppercase"><i class="fa fa-times"></i> Cancel</span>
                                     @elseif($deposit->status == 0)
                                            <span class="label label-warning bold uppercase"><i class="fa fa-spinner"></i> Pending</span>
                                    @endif
							</h3>
                            <hr>
							@if($deposit->status == 0)
                            <div class="col-md-3 col-md-offset-3">
                                <button type="button" class="btn btn-success bold uppercase btn-block delete_button"
                                        data-toggle="modal" data-target="#DelModal"
                                        data-id="{{ $deposit->id }}">
                                    <i class='fa fa-check'></i> Approve Payment
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger bold uppercase btn-block cancel_button"
                                        data-toggle="modal" data-target="#cancelModal"
                                        data-id="{{ $deposit->id }}">
                                    <i class='fa fa-times'></i> Cancel Payment
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Message : </h3><br>
                            {!! $deposit->message !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            @php $img = \App\DepositImage::whereDeposit_id($deposit->id)->get() @endphp
                            @foreach($img as $im)
                            <div class="col-md-4">
                                <a target="_blank" href="{{ asset('assets/deposit') }}/{{ $im->image }}">
                                    <img src="{{ asset('assets/deposit') }}/{{ $im->image }}" class="img-responsive" alt="">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->
   
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> <strong>Confirmation..!</strong></h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you Want to Approve This Deposit Request..?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-deposit-approve') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes. I am Sure.</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title  bold uppercase" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> <strong>Confirmation..!</strong></h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you Want to Cancel This Deposit Request..?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-deposit-cancel') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes. I am Sure.</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection
@section('scripts')


    @if (session('alert'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "{!! session('alert') !!}", "error");

            });

        </script>

    @endif


    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
        $(document).ready(function () {

            $(document).on("click", '.cancel_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

@endsection
