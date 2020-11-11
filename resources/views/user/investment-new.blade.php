@extends('layouts.user-frontend.user-dashboard')

@section('content')
@include('layouts.breadcam')

<div class="content_padding">
    <div class="container user-dashboard-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row new-investment-user">
                    @foreach($plan as $p)

                        <div class="col-sm-4 text-center">
                            <div class="panel panel-green panel-pricing">
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
                                </ul>
                                <div class="panel-footer" style="overflow: hidden">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary bold uppercase btn-block btn-icon icon-left plan_id radious-zero" value="{{$p->id}}" data-toggle="modal" data-target="#invest_review_modal">
                                                <i class="fa fa-send"></i> Invest Under This Package
                                            </button>
                                        <form method="POST" action="{{ route('investment-post') }}" class="form-inline">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $p->id }}">
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div><!---ROW-->
    </div>
</div>



<!-- Modal -->
  <div class="modal fade" id="invest_review_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Investment:</h4>
        </div>
        <div class="modal-body">
              <div class="row">
        <div class="col-md-4">
            <div class="col-sm-12 text-center">
                <div class="panel panel-default panel-pricing">
                    <div style="padding: 10px" class="panel-heading">
                        <h3 style="font-size: 28px;"><b style="color:#ffffff"><span id="name"></span></b></h3>
                    </div>
                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                        <p><strong style="font-size: 20px;"> <span id="min_amount"></span> - <span id="max_amount"></span> {{ $basic->currency }}</strong></p>
                    </div>
                    <ul style="font-size: 15px;" class="list-group text-center bold">
                        <li class="list-group-item" style="padding: 18px 0px;">
                            <i class="fa fa-check"></i> Commission - <span id="percentage"></span> <i class="fa fa-percent"></i> 
                        </li>
                        <li class="list-group-item" style="padding: 18px 0px;">
                            <i class="fa fa-check"></i> Repeat - <span id="time"></span> Times 
                        </li>
                        <li class="list-group-item" style="padding: 18px 0px;">
                            <i class="fa fa-check"></i> Compound - <span class="aaaa"><span id="compound_name"></span></span>
                        </li>
                    </ul>
                    <div class="panel-footer" style="overflow: hidden">
                        <div class="col-sm-12">
                            <button class="btn btn-primary bold uppercase btn-block btn-icon icon-left radious-zero"  data-dismiss="modal">
                                <i class="fa fa-arrow-left"></i> Change Package
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title bold uppercase"><i class="fa fa-eye"></i> <strong>Investment Review</strong></div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div class="row">
                           <div class="col-md-6" style="padding-right:0px;">
                                  <div class="text-left">
                                    <h5 class="bold uppercase">Current Balance: <strong>{{ round(Auth::user()->balance, $basic->deci) }} - {{ $basic->currency }}</strong></h5>
                                </div>
                            </div>
                            
                            <div class="col-md-6" style="padding-right:0px;">
                                <div class="text-left">
                                  <h5 class="bold uppercase" >Remain Balance: <strong> <span id="remain_balance">{{ round(Auth::user()->balance, $basic->deci) }}</span> - {{ $basic->currency }}</strong></h5>
                                </div>       
                            </div>      
                    </div>
                        <ul style='font-size: 15px;' class="list-group bold">
                             
                             <li class="list-group-item">
                                <div class="row">
                                <div class="col-md-5 text-right">
                                   Investment Amount :
                                </div>    
                                <div class="col-md-7 text-left">
                                     <div class="input-group">
                                        <input type="text" value="" name="amount" id="amount" class="form-control bold" placeholder="Invest Amount" required>
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                       
                                    </div>
                                </div>    
                                </div>
                             </li>

                             <li class="list-group-item">
                                <div class="row">
                                <div class="col-md-5 text-right">
                                  Per Time: 
                                </div>    
                                <div class="col-md-7 text-left">
                                   <div class="input-group">
                                        <input type="text" value="" name="amount" id="comission_amount" class="form-control bold" placeholder="Per Time" readonly>
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                        
                                    </div>
                                </div>    
                                </div>
                             </li>

                              <li class="list-group-item">
                                <div class="row">
                                <div class="col-md-5 text-right">
                                    Total Return: 
                                </div>    
                                <div class="col-md-7 text-left">
                                   <div class="input-group">
                                        <input type="text" value="" name="amount" id="total_return" class="form-control bold" placeholder="Total Return" readonly>
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                       
                                    </div>
                                </div>    
                                </div>
                             </li>

                             <li class="list-group-item">
                                <div class="row">
                                <div class="col-md-5 text-right">
                                   Total Interest: 
                                </div>    
                                <div class="col-md-7 text-left">
                                    <div class="input-group">
                                        <input type="text" value="" name="amount" id="total_interest" class="form-control bold" placeholder="Total Interest" readonly>
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                    </div>
                                </div>    
                                </div>
                             </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
                <div class="form-group">
                  <form method="post" action="{{ route('investment-submit') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="amount" id ="c_amount" value="0">
                        <input type="hidden" name="plan_id" id="plan_id" value="">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div id="result"></div>
                    </form>
                        
                </div>
            </div>
        </div>
            
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

@endsection
@section('script')
<script>
        $(document).ready(function () {

            /*Modal load activities*/
            $(document).on("click", '.plan_id', function (e) {
                var id = $(this).val();

                $("#amount").val('');
                $("#comission_amount").val('');
                $("#total_return").val('');
                $("#total_interest").val('');

                 $.post(
                        '{{ route('invest-amount-review') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            id : id,
                        },
                        function(data) {
                            console.log(data);
                            $("#plan_id").val(data.id);
                            $("#name").text(data.name);
                            $("#min_amount").text(data.minimum);
                            $("#max_amount").text(data.maximum);
                            $("#percentage").text(data.percent);
                            $("#compound_name").text(data.compound_name);
                            $("#time").text(data.time);

                            $("#result").html(data);
                        }
                );

            });

             /*Modal data review activities*/
            $('#amount').on('keypress, keyup', function() {
                
                var amount          = parseInt($("#amount").val());
                var plan            = $("#plan_id").val();
                var balance         = "{{ round(Auth::user()->balance, $basic->deci) }}";
                var comissionRate   = parseInt($("#percentage").text())/100;   
                var comissionTime   = parseInt($("#time").text());
                var comissionAmount = amount * comissionRate;
                var totalReturn     = comissionAmount * comissionTime;
                var totalInterest   = totalReturn - amount;

                var remainBalance = parseInt(balance)-parseInt(amount);
                if(amount == ''|| amount <=0){

                    $("#remain_balance").text(balance);
                        
                        InputBoxZero();

                }else if(amount<=balance){
                     
                      $("#remain_balance").text(remainBalance);
                     
                      $("#comission_amount").val(comissionAmount);
                      $("#total_return").val(totalReturn);
                      $("#total_interest").val(totalInterest);

                }else if(amount>balance){
                        swal("Ops!", "Input amount not available in your balance!", "error")
                        $("#amount").val('');
                        InputBoxZero();
                        $("#remain_balance").text(balance);
                }else{
                    $("#remain_balance").text(balance);
                    InputBoxZero();
                }

                if(amount>balance){
                    $("#c_amount").val(0); 
                }else{
                    $("#c_amount").val(amount); 
                }

                $.post(
                        '{{ url('/user/invest-amount-chk') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            amount : amount,
                            plan : plan
                        },
                        function(data) {

                            $("#result").html(data);
                        }
                );
            });

            function InputBoxZero(){
                $("#comission_amount").val('');
                $("#total_return").val('');
                $("#total_interest").val('');
            }
        });
</script>

    @if (session('success'))
        <script type="text/javascript">
            $(document).ready(function(){

                swal("Success!", "{{ session('success') }}", "success");

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

