@extends('layouts.user-frontend.user-dashboard')
@section('style')
    <style>
            .input-text-box input{
            border: 1px solid #CCCCCC;
            }
        </style>

    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>
      

@endsection
@section('content')
@include('layouts.breadcam')
<div class="content_padding">
    <div class="container user-dashboard-body">  

    <div class="row">
        <div class="col-md-8 col-sm-12 col-md-offset-2">
            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-money"></i> Deposit Method <strong> {{ $fund->payment->name }}</strong>
                    <div class="pull-right">
                        <a href="{{ route('deposit-fund') }}" class="label label-default" style="padding: 10px;"><i
                                class="fa fa-arrow-left"></i> Back to Payment Method Page</a>
                    </div>
                    </div>

                </div>
                <div class="panel-body">
                    
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Deposit Amount : </strong></label>

                                <div class="col-sm-5">
                                    <div class="input-group input-text-box">
                                        <input type="text" value="{{ $fund->amount }}" readonly name="amount" id="amount" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong>{{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Charge : </strong></label>

                                <div class="col-sm-5">
                                    <div class="input-group input-text-box">
                                        <input type="text" value="{{ $fund->charge }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Send : </strong></label>

                                <div class="col-sm-5">
                                    <div class="input-group input-text-box">
                                        <input type="text" value="{{ $fund->amount + $fund->charge }}" readonly name="" id="" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Conversion Rate : </strong></label>

                                <div class="col-sm-5">
                                    <div class="input-group input-text-box">
                                        <input type="text" value="1 USD = {{ $fund->payment->rate }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Amount : </strong></label>

                                <div class="col-sm-5">
                                    <div class="input-group input-text-box">
                                        <input type="text" value="{{ round($fund->usd, $basic->deci)  }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> USD </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                             <div class="form-group">
                                <div class="col-md-12">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <a href="{{route('deposit-confirm')}}"  id="btn-confirm" class="btn btn-primary btn-block btn-icon bold icon-left"><i
                                                        class="fa fa-send"></i> Add Fund Now</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                </div>
                <!-- panel body -->
            </div>
        </div>
    </div>

    </div>
</div>

@endsection
@section('script')
    @if($fund->payment_type == 107)
        <form action="{{ route('ipn.paystack') }}" method="POST">
            @csrf
            <script

                    src="//js.paystack.co/v1/inline.js"
                    data-key="{{ $fund->payment->val1 }}"
                    data-email="{{ $fund->user->email }}"
                    data-amount="{{ round($fund->usd/$fund->payment->val7, 2)*100 }}"
                    data-currency="NGN"
                    data-ref="{{ $fund->custom }}"
                    data-custom-button="btn-confirm"
            >
            </script>
        </form>
    @elseif($fund->payment_type == 108)
        <script src="//voguepay.com/js/voguepay.js"></script>
        <script>
            closedFunction = function() {

            }
            successFunction = function(transaction_id) {
                window.location.href = '{{ url('user/deposit-history') }}';
            }
            failedFunction=function(transaction_id) {
                window.location.href = '{{ url('user/dashboard') }}';
            }

            function pay(item, price) {
                Voguepay.init({
                    v_merchant_id: "{{ $fund->payment->val1 }}",
                    total: price,
                    notify_url: "{{ route('ipn.voguepay') }}",
                    cur: 'USD',
                    merchant_ref: "{{ $fund->custom }}",
                    memo:'Deposit',
                    recurrent: true,
                    frequency: 10,
                    developer_code: '5af93ca2913fd',
                    store_id:"{{ $fund->member_id }}",
                    custom: "{{ $fund->custom }}",

                    closed:closedFunction,
                    success:successFunction,
                    failed:failedFunction
                });
            }

            $(document).ready(function () {
                $(document).on('click', '#btn-confirm', function (e) {
                    e.preventDefault();
                    pay('Deposit', {{ $fund->usd }});
                });
            })
        </script>

    @endif
@endsection