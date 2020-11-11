@extends('layouts.user-frontend.user-dashboard')
@section('style')
<style>
	.credit-card-box .form-control.error {
		border-color: red;
		outline: 0;
		box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
	}
	.credit-card-box label.error {
		font-weight: bold;
		color: red;
		padding: 2px 8px;
		margin-top: 2px;
	}
</style>
@endsection
@section('content')

<div class="content_padding">
	<div class="container user-dashboard-body">  
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light bordered">
					<div class="portlet-title">
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-8 col-sm-12 col-md-offset-2">
								<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

									<!-- panel head -->
									<div class="panel-heading">
										<div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>
									</div>
									<!-- panel body -->
									<div class="panel-body">
										<div class="col-md-12 ">
											<div class="card-wrapper"></div>
											<hr/>
										</div>

										<div  class="col-md-12 text-center">
											<form role="form" id="payment-form" method="POST" action="{{ route('ipn.stripe')}}" >
												{{csrf_field()}}
												<input type="hidden" value="{{ $track }}" name="track">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="name">CARD NAME</label>
															<div class="input-group">
																<input
																type="text"
																class="form-control input-lg"
																name="name"
																placeholder="Card Name"
																autocomplete="off" autofocus
																/>
																<span class="input-group-addon"><i class="fa fa-font"></i></span>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="cardNumber">CARD NUMBER</label>
															<div class="input-group">
																<input
																type="tel"
																class="form-control input-lg"
																name="cardNumber"
																placeholder="Valid Card Number"
																autocomplete="off"
																required autofocus
																/>
																<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
															</div>
														</div>
													</div>
												</div>
												<br>
												
												<div class="row">
													<div class="col-sm-7">
														<div class="form-group">
															<label for="cardExpiry">EXPIRATION DATE</label>
															<input
															type="tel"
															class="form-control input-lg input-sz"
															name="cardExpiry"
															placeholder="MM / YYYY"
															autocomplete="off"
															required
															/>
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="cardCVC">CVC CODE</label>
															<input
															type="tel"
															class="form-control input-lg input-sz"
															name="cardCVC"
															placeholder="CVC"
															autocomplete="off"
															required
															/>
														</div>
													</div>
												</div>					
												<div class="row">
													<div class="col-xs-12">
														<button class="btn btn-success btn-lg btn-block" type="submit"> PAY NOW </button>
													</div>
												</div>
												
											</form>
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
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/card.min.js"></script>
<script>
	(function ($) {
		$(document).ready(function () {
			var card = new Card({
				form: '#payment-form',
				container: '.card-wrapper',
				formSelectors: {
					numberInput: 'input[name="cardNumber"]',
					expiryInput: 'input[name="cardExpiry"]',
					cvcInput: 'input[name="cardCVC"]',
					nameInput: 'input[name="name"]'
				}
			});
		});
	})(jQuery);
</script>
@endsection


