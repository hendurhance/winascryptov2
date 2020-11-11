@extends('layouts.user-frontend.user-dashboard')

@section('content')
@include('layouts.breadcam')
<section>
<div class="content_padding">
    <div class="container user-dashboard-body"> 
    <div class="panel panel-info">
      <div class="panel-heading"><h3>Depoist Method: <b>{{ $trans->payment->name }}</b></h3></div>
      <div class="panel-body">
           <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Deposit Amount : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $trans->amount }}" readonly name="amount" id="amount" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Deposit Charge : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $trans->charge }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Amount : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $trans->amount + $trans->charge }}" readonly name="" id="" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                          <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>1 {{ $basic->currency }} : </strong></label>

                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" value=" {{ $trans->payment->rate }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                            <span class="input-group-addon red">&nbsp;<strong> {{ $trans->payment->currency }} </strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <br>
                              <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Send : </strong></label>

                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" value="{{ $trans->net_amount * $trans->payment->rate }}" readonly name="" id="" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                            <span class="input-group-addon red">&nbsp;<strong> {{ $trans->payment->currency }} </strong></span>
                                        </div>
                                    </div>
                                </div>
                             </div>
                 </div>
            </div>     
            
                        <div class="panel panel-success">
                          <div class="panel-heading"><h3>SENDING DETAILS of METHOD <b>{{ $trans->payment->name }}</b></h3></div>
                                <div class="panel-body">
                                     <div class="row">
                                    
                                        <div class="form-group">
                                            <div class="col-sm-8 col-md-offset-2 text-center">
                                                @if($trans->payment->id == 101)
                                                    @php 
                                                            $redst = "color:red;";
                                                            $sendto = $trans->payment->val1;
                                                            $usd = $trans->usd;
                                                            $var = "bitcoin:$sendto?amount=$usd";
                                                            $scan =  "<div class='text-center'><img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;'  /> </div>";
                                                        @endphp
                                                        <strong style="font-size: 20px;">Send Amount : {{ $trans->btc_amo }} BTC <br>TO </strong>
                                                        <strong style="font-size: 20px; {{ $redst }}">
                                                                {!! $trans->payment->val1 !!}
                                                        </strong>
                                                        <br>
                                                        {!! $scan !!}
                                                    <h2 class="text-center bold">Scan to send</h2>
                                                    @else
                                                <strong style="font-size: 20px;">Send Amount : {{ $trans->net_amount * $trans->payment->rate }} {{ $trans->payment->currency }}</strong><br>
                                                    <strong style="font-size: 20px;">{!! $trans->payment->val1 !!}</strong><br> 
                                             @endif

                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel panel-success">
                          <div class="panel-heading"><h3>DEPOSIT PROOF</b></h3></div>
                                <div class="panel-body">
                                      <div class="row">
                                        {!! Form::open(['route'=>'manual-deposit-submit','class'=>'form-horizontal','files'=>true,'novalidate'=>'']) !!}


                                        <input type="hidden" name="fund_id" value="{{ $trans->id }}">
                                      </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-1 text-right control-label"><strong>Select Multiple Image : </strong></label>

                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="file" value="" name="image[]" multiple class="form-control bold" required>
                                                        <span class="input-group-addon red">&nbsp;<strong> <i class="fa fa-picture-o"></i> </strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="form-group">
                                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-1 text-right control-label"><strong>Message : </strong></label>

                                                <div class="col-sm-6">
                                                                <textarea name="message" id="area1" cols="30" rows="3"
                                                                          class="input-lg form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-6 col-sm-offset-4">
                                                    <button class="btn-primary btn-block bold btn-lg"><i class="fa fa-send"></i> Submit Now</button>
                                                </div>
                                            </div>
                                        </div>



                                        {!! Form::close() !!}
                                    </div>

                                </div>

                                    
        </div>
    </div>
</section>
                        

@endsection