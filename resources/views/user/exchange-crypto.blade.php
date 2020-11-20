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
                 <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#sell_bitcoin">SELL</button>
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
                 <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#sell_ethereum">SELL</button>
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

<!-- end  -->

<div>
<!-- Sell Bitcoin Modal  -->

<div class="modal fade" id="sell_bitcoin" role="dialog" aria-labelledby="sell_bitcoin" aria-hidden="true">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sell Bitcoin</h4>
        </div>
        <div class="modal-body">
          <div class="exchange-modal">
             <p class="text-center">Available Balance: <strong id="remainBal2"> </strong></p>
               <div class="input-group">
                 <input type="text" id="btcsalevalue" class="form-control bold" placeholder="Amount of BTC to Sell" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fab fa-bitcoin"></i></strong></span>
               </div>
               <br>
               <div class="input-group">
                 <input type="text" id="usdtobtc" class="form-control bold" placeholder="Price in USD" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fas fa-dollar-sign"></i></strong></span>
               </div>
               <br>
               <form action="{{ route('sell-btc-submit') }}" method="post">
               {!! csrf_field() !!}
               <input type="hidden" id="c_btcsalevalue" name="btcsaleamount" >
               <input type="hidden" id="c_usdtobtc" name="usdtobtc" >
               <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
               <button id="submitSellBtc" type="submit" class="btn btn-primary bold uppercase btn-block btn-sm">
                    <i class="fa fa-cloud-upload"></i> Sell Bitcoin
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
             <p class="text-center">Available Balance: <strong id="remainBal1"> </strong></p>
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
               <form action="{{ route('buy-eth-submit') }}" method="post">
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

<div>
<!-- Sell Ethereum Modal  -->
<section>
<div class="modal fade" id="sell_ethereum" role="dialog" aria-labelledby="sell_ethereum" aria-hidden="true">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sell Ethereum</h4>
        </div>
        <div class="modal-body">
          <div class="exchange-modal">
             <p class="text-center">Available Balance: <strong id="remainBal3"> </strong></p>
               <div class="input-group">
                 <input type="text" id="ethsalevalue" class="form-control bold" placeholder="Amount of ETH to Sell" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fab fa-ethereum"></i></strong></span>
               </div>
               <br>
               <div class="input-group">
                 <input type="text" id="usdtoeth" class="form-control bold" placeholder="Price in USD" required>
                 <span class="input-group-addon">&nbsp;<strong><i class="fas fa-dollar-sign"></i></strong></span>
               </div>
               <br>
               <form action="{{ route('sell-eth-submit') }}" method="post">
               {!! csrf_field() !!}
               <input type="hidden" id="c_ethsalevalue" name="ethsaleamount" >
               <input type="hidden" id="c_usdtoeth" name="usdtoeth" >
               <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
               <button id="submitSellEth" type="submit" class="btn btn-primary bold uppercase btn-block btn-sm">
                    <i class="fa fa-cloud-upload"></i> Sell Ethereum
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
document.getElementById("ethtousd").disabled = true;
document.getElementById("submitBuyEth").disabled = true;
document.getElementById("submitSellBtc").disabled = true;
document.getElementById("usdtobtc").disabled = true;
document.getElementById("submitSellEth").disabled = true;
document.getElementById("usdtoeth").disabled = true;

$(document).ready(function () {

  // Modal for BTC
    $('#btcvalue').on('keypress, keyup', function(){
      $.ajax({
        type: 'GET',
        url: 'https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey=053B4BB2-6459-40F1-9688-2B2E6C8909FA',
        success: function (data) {
            let rates = data.rate
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
            }else{
              document.getElementById("submitBuyBtc").disabled = false;
            }
        }
    })
 })

 $('#btcsalevalue').on('keypress, keyup', function(){
      $.ajax({
        type: 'GET',
        url: 'https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey=053B4BB2-6459-40F1-9688-2B2E6C8909FA',
        success: function (data) {
            let rates = data.rate
            let amount = $("#btcsalevalue").val();
            let calc = amount * rates;
            console.log(Math.round(calc * 1000) / 1000);
            let balance = "{{ Auth::user()->btc_wallet }}";
            let remainBalance = parseInt(balance)-parseInt(amount);
            $("#remainBal2").html(remainBalance);
            $("#usdtobtc").val(Math.round(calc * 1000) / 1000);
            
            if (amount == '' || amount <= 0) {
              document.getElementById("submitSellBtc").disabled = true;
            }
            else if(amount > balance) {
              swal("Ops!", "Insufficient balance!", "error");
              document.getElementById("submitSellBtc").disabled = true;
              $("#remainBal2").html("");
            }else if(amount < balance){
              $("#c_usdtobtc").val(Math.round(calc * 1000) / 1000);
              $("#c_btcsalevalue").val(amount);
              document.getElementById("submitSellBtc").disabled = false;
            }else{
              document.getElementById("submitSellBtc").disabled = false;
            }
        }
    })
            
          
 })

   // Modal for ETH
$('#ethvalue').on('keypress, keyup', function(){
      $.ajax({
        type: 'GET',
        url: 'https://rest.coinapi.io/v1/exchangerate/ETH/USD?apikey=053B4BB2-6459-40F1-9688-2B2E6C8909FA',
        success: function (data) {
            let rates = data.rate
            let amount = $("#ethvalue").val();
            let calc = amount * rates;
            console.log(Math.round(calc * 1000) / 1000);
            let balance = "{{ round(Auth::user()->balance, $basic->deci) }}";
            let remainBalance = parseInt(balance)-parseInt(calc);
            $("#remainBal1").html(remainBalance);
            $("#ethtousd").val(Math.round(calc * 1000) / 1000);
            
            if (amount == '' || amount <= 0) {
              document.getElementById("submitBuyEth").disabled = true;
            }
            else if(calc > balance) {
              swal("Ops!", "Insufficient balance!", "error");
              document.getElementById("submitBuyEth").disabled = true;
              $("#remainBal1").html("");
            }else if(calc < balance){
              $("#c_ethtousd").val(Math.round(calc * 1000) / 1000);
              $("#c_ethvalue").val(amount);
              document.getElementById("submitBuyEth").disabled = false;
            }else{
              document.getElementById("submitBuyEth").disabled = false;
            }
        }
    })
})
       // Modal for Sell ETH
  $('#ethsalevalue').on('keypress, keyup', function(){
      $.ajax({
        type: 'GET',
        url: 'https://rest.coinapi.io/v1/exchangerate/ETH/USD?apikey=053B4BB2-6459-40F1-9688-2B2E6C8909FA',
        success: function (data) {
            let rates = data.rate
            const amount = $("#ethsalevalue").val();
            const calc = amount * rates;
            console.log(Math.round(calc * 1000) / 1000);
            const balance = "{{ Auth::user()->eth_wallet }}";
            const remainBalance = parseInt(balance)-parseInt(amount);
            $("#remainBal3").html(remainBalance);
            $("#usdtoeth").val(Math.round(calc * 1000) / 1000);
            
            if (parseInt(amount) == '' || parseInt(amount) <= 0) {
              document.getElementById("submitSellEth").disabled = true;
            }else if(parseInt(amount) > parseInt(balance)){
              swal("Ops!", "Insufficient balance!", "error");
              document.getElementById("submitSellEth").disabled = true;
              $("#remainBal3").html("");
            }else if (parseInt(amount) < parseInt(balance)){
              $("#c_usdtoeth").val(Math.round(calc * 1000) / 1000);
              $("#c_ethsalevalue").val(amount);
              document.getElementById("submitSellEth").disabled = false;
            }else{
              document.getElementById("submitSellEth").disabled = false;
            }
        }
     })
            
            
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