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
                  <div class="col-lg-4">
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
                  <div class="col-lg-4">
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
                  <div class="col-lg-4">
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

</div>

</section>

@endsection

@section('script')
<script src=https://kit.fontawesome.com/69ad3e7b09.js></script>
@endsection