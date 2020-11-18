@extends('layouts.user-frontend.user-dashboard')

@section('style')
<style>
 .wallet-div{
     padding: 1em;
     background-color: #f0ede8;
     border-radius: 5px;
 }
 .wallet-text{
     font-size: 1.2em;
     font-weight: bolder;
 }

 .wallet-exchange-div{
     background-color: #f0ede8;
     padding: 2em;
     border-radius: 5px;
 }

 .font-weight-bolder{
     font-weight: bolder;
 }

 .btn-xch{
     margin-top: 3.5em;
 } 

 @media screen and (max-width: 768px){
     .wallet-div, .wallet-exchange-div{
         margin-top: 1em;
     }
 }

</style>
@endsection

@section('content')
@include('layouts.breadcam')

<section>

<div class="content_padding">
  
  <div class="container exchange-crypto">
    <div class="clearfix"></div>
    <br>
      <div class="panel panel-default">
         <div class="panel-heading"> <h3 style="color: #fff"> Account Wallet</h3></div>
            <div class="panel-body">
              <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                     <div class="wallet-div">
                       <div class="row">
                        <div class="col-xs-3">
                        <i class="fa fa-money fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right wallet-text">
                         USD  <span data-counter="counterup" data-value="{{ round($balance->balance, $basic->deci) }}">{{ round($balance->balance, $basic->deci) }}</span>
                        </div>
                       </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                     <div class="wallet-div">
                       <div class="row">
                        <div class="col-xs-3">
                        <i class="fab fa-bitcoin fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right wallet-text">
                         BTC  <span data-counter="counterup" data-value="{{ round($btc_wallet->btc_wallet, $basic->deci) }}">{{ round($btc_wallet->btc_wallet, $basic->deci) }}</span>
                        </div>
                       </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                     <div class="wallet-div">
                       <div class="row">
                        <div class="col-xs-3">
                        <i class="fab fa-ethereum fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right wallet-text">
                         ETH  <span data-counter="counterup" data-value="{{ round($eth_wallet->eth_wallet, $basic->deci) }}">{{ round($eth_wallet->eth_wallet, $basic->deci) }}</span>
                        </div>
                       </div>
                     </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
  </div>

 <div class="clearfix"></div> <br>

  <div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="wallet-exchange-div">
            <div class="row">
             <div class="col-xs-4">
               <img src="../../assets/img/xbt.png" alt="Bitcoin" >
             </div>
             <div class="col-xs-8 text-right">
               <p class="font-weight-bolder">BTC TRANSACTION</p>
               <div class="d-flex btn-xch">
                 <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#buy_bitcoin">BUY</button>
                 <button class="btn btn-primary">SELL</button>
               </div>
             </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="wallet-exchange-div">
          <div class="row">
             <div class="col-xs-4">
               <img src="../../assets/img/eth.png" alt="Bitcoin" >
             </div>
             <div class="col-xs-8 text-right">
               <p class="font-weight-bolder">ETH TRANSACTION</p>
               <div class="d-flex btn-xch">
                 <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#buy_ethereum">BUY</button>
                 <button class="btn btn-primary">SELL</button>
               </div>
             </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <br><br>
 <div class="clearfix"></div>
</div>

<div>
<!-- Buy Bitcoin Modal  -->

<div class="modal fade" id="buy_bitcoin" role="dialog" aria-labelledby="buy_bitcoin" aria-hidden="true">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Buy Bitcoin</h4>
        </div>
        <div class="modal-body">
          <div class="exchange-modal">
             <p class="text-center">Available Balance: <strong id="remainBal"> </strong></p>
               <div class="input-group">
                 <input type="text" id="btcvalue" class="form-control bold" placeholder="Amount of BTC Purchase" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fab fa-bitcoin"></i></strong></span>
               </div>
               <br>
               <div class="input-group">
                 <input type="text" id="btctousd" class="form-control bold" placeholder="Price in USD" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fas fa-dollar-sign"></i></strong></span>
               </div>
               <br>
               <form action="{{ route('buy-btc-submit') }}" method="post">
               {!! csrf_field() !!}
               <input type="hidden" id="c_btcvalue" name="btcamount" >
               <input type="hidden" id="c_btctousd" name="btctousd" >
               <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
               <button id="submitBuyBtc" type="submit" class="btn btn-primary bold uppercase btn-block btn-sm">
                    <i class="fa fa-cloud-upload"></i> Buy Bitcoin
                </button>
             </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
</section>
</div>


<div>
<!-- Buy Ethereum Modal  -->
<section>
<div class="modal fade" id="buy_ethereum" role="dialog" aria-labelledby="buy_ethereum" aria-hidden="true">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Buy Ethereum</h4>
        </div>
        <div class="modal-body">
          <div class="exchange-modal">
             <p class="text-center">Available Balance: <strong id="remainBal"> </strong></p>
               <div class="input-group">
                 <input type="text" id="ethvalue" class="form-control bold" placeholder="Amount of ETH Purchase" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fab fa-ethereum"></i></strong></span>
               </div>
               <br>
               <div class="input-group">
                 <input type="text" id="ethtousd" class="form-control bold" placeholder="Price in USD" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fas fa-dollar-sign"></i></strong></span>
               </div>
               <br>
               <form action="" method="post">
               {!! csrf_field() !!}
               <input type="hidden" id="c_ethvalue" name="ethamount" >
               <input type="hidden" id="c_ethtousd" name="ethtousd" >
               <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
               <button id="submitBuyEth" type="submit" class="btn btn-primary bold uppercase btn-block btn-sm">
                    <i class="fa fa-cloud-upload"></i> Buy Ethereum
                </button>
             </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
</section>
</div>
@endsection




@section('script')
<script src=https://kit.fontawesome.com/69ad3e7b09.js></script>
<script>
//Disable input
document.getElementById("btctousd").disabled = true;
document.getElementById("submitBuyBtc").disabled = true;
$(document).ready(function () {

  // Modal
    $('#btcvalue').on('keypress, keyup', function(){
    //   $.ajax({
    //     type: 'GET',
    //     url: 'https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey=053B4BB2-6459-40F1-9688-2B2E6C8909FA',
    //     success: function (data) {
    //         let rates = data.rate
    //         let amount = $("#btcvalue").val();
    //         let calc = parseInt(amount) * parseInt(rates);
    //         console.log(calc);
    //         let balance = "{{ round(Auth::user()->balance, $basic->deci) }}";
    //         let remainBalance = parseInt(balance)-parseInt(calc);
    //         $("#remainBal").html(remainBalance);
    //         $("#btctousd").val(parseInt(calc));
            
    //         if (amount == '' || amount <= 0) {
    //           document.getElementById("submitBuyBtc").disabled = true;
    //         }
    //         else if(calc > balance) {
    //           swal("Ops!", "Insufficient balance!", "error");
    //           document.getElementById("submitBuyBtc").disabled = true;
    //           $("#remainBal").html("");
    //         }else{
    //           document.getElementById("submitBuyBtc").disabled = false;
    //         }
    //     }
      
    // })
            let rates = 13731.2207888;
            let amount = $("#btcvalue").val();
            let calc = amount * rates;
            console.log(Math.round(calc * 1000) / 1000);
            let balance = "{{ round(Auth::user()->balance, $basic->deci) }}";
            let remainBalance = parseInt(balance)-parseInt(calc);
            $("#remainBal").html(remainBalance);
            $("#btctousd").val(Math.round(calc * 1000) / 1000);
            
            if (amount == '' || amount <= 0) {
              document.getElementById("submitBuyBtc").disabled = true;
            }
            else if(calc > balance) {
              swal("Ops!", "Insufficient balance!", "error");
              document.getElementById("submitBuyBtc").disabled = true;
              $("#remainBal").html("");
            }else if(calc < balance){
              $("#c_btctousd").val(Math.round(calc * 1000) / 1000);
              $("#c_btcvalue").val(amount);
              document.getElementById("submitBuyBtc").disabled = false;
            }
            else{
              document.getElementById("submitBuyBtc").disabled = false;
            }
      

       
  })
})
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