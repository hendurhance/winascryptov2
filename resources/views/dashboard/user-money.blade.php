@extends('layouts.dashboard')
@section('style')

    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">

@endsection
@section('content')


    <div class="row">
        <div class="col-md-8">



            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption uppercase bold">
                        <i class="fa fa-cog"></i>   add / substruct balance to {{ $user->name }} - {{ $user->username }}
                    </div>
                </div>
                <div class="portlet-body">


                    <form action="{{ route('user-money-submit') }}" method="post" novalidate="">
                    {!! csrf_field() !!}

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="row uppercase">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>OPERATION</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" checked data-onstyle="success" data-offstyle="danger" data-on="Add Money" data-off="substruct Money"  data-width="100%" data-height="46" type="checkbox" name="operation">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Amount</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <input class="form-control bold input-lg" name="amount"  type="text" required="">
                                            <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->

                        <br><br>

                        <div class="row uppercase">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Reason</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="reason" rows="4" class="form-control" placeholder="Reason" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->

                        <br>
                        <div class="row uppercase">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"> SUBMIT </button>
                                </div>
                            </div>
                        </div><!-- row -->

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption uppercase bold">
                        <i class="fa fa-money"></i>  CURRENT BALANCE</div>
                </div>
                <div class="portlet-body text-center">

                    <h3>CURRENT BALANCE OF <br><br> <strong>Name : {{ $user->name }} <br>User Name : {{ $user->username }} </strong></h3>

                    <h1><strong>
                            @php $bal = \App\User::whereId($user->id)->first() @endphp
                            {{ $bal->balance }} - {{ $basic->currency }}</strong>
                    </h1>
                </div>
            </div>
        </div>

    </div><!-- ROW-->

@endsection
@section('scripts')

    @if (session('alert'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "{!! session('alert') !!}", "error");

            });

        </script>

    @endif

    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>

@endsection

