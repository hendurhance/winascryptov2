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
                 <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exchange_crypto">BUY</button>
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
                 <button class="btn btn-primary">BUY</button>
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

<div class="modal fade" id="exchange_crypto" role="dialog">
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
               <input type="text" name="btcvalue" id="btcvalue" class="form-control bold" placeholder="Amount of BTC Purchase" required>
               <span class="input-group-addon">&nbsp;<strong><i class="fab fa-bitcoin"></i></strong></span>
             </div>
             <br>
             <div class="input-group">
               <input type="text" value="" name="btctousd" id="btctousd" class="form-control bold" placeholder="Amount of BTC Purchase" required>
               <span class="input-group-addon">&nbsp;<strong><i class="fas fa-dollar-sign"></i></strong></span>
             </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
</section>

@endsection



@section('script')
<script src=https://kit.fontawesome.com/69ad3e7b09.js></script>
<script>
    document.getElementById("btctousd").disabled = true;
</script>
<script>
$(document).ready(function () {

  // Modal
    $('#btcvalue').on('keypress, keyup', function(){
      // $.ajax({
      //   type: 'GET',
      //   url: 'https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey=053B4BB2-6459-40F1-9688-2B2E6C8909FA',
      //   success: function (data) {
      //       let rates = data.rate
      //       let amount = $("#btcvalue").val();
      //       let calc = amount * rates;
      //       console.log(calc);
      //   }
      // 
    // })
      let balance = "{{ round(Auth::user()->balance, $basic->deci) }}";
      let rates = 40;
      let amount = $("#btcvalue").val();
      let calc = amount * rates;
      let remainBalance = parseInt(balance)-parseInt(calc);
      console.log(calc);
      $("#remainBal").html(remainBalance);
      $("#btctousd").val(calc);
      
      if (calc > balance) {
        swal("Ops!", "Insufficient balance!", "error");
        $("#remainBal").html("");
      }

       
    })
})
</script>
@endsection