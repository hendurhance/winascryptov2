@extends('layouts.fontEnd')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ranger-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.skinFlat.css') }}">
    <style>
        .price-table {
            margin-bottom: 45px;
        }
    </style>

@endsection
@section('content')
<section class="header-section ">
    <div class="head-slider">
        @foreach($slider as $s)
            <div class="single-header slider header-bg" style="background-image: url('{{ asset('assets/images/slider') }}/{{ $s->image }}')">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="header-slider-wrapper">
                                <h1>{{ $s->title }}</h1>
                                <p>{{ $s->subtitle }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>
</section><!--Header section end-->

<!--About community Section Start-->
<section class="section-padding about-community">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2>about - {{ $site_title }}</h2>
                    <p>{!! $page->about_subtitle !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="about-community-text text-right">
                    {!! $page->about_leftText !!}
                </p>
            </div>
            <div class="col-md-6">
                <p class="about-community-text">
                    {!! $page->about_rightText !!}
                </p>
            </div>
        </div>
    </div>
</section><!--About community Section end-->

<!--service section start-->
<section class="section-padding service-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center section-padding padding-bottom-0">
                    <h2>Services - {{ $site_title }}</h2>
                    <p>{!! $page->service_subtitle !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($service as $s)
            <div class="col-md-3 col-sm-6">
                <div class="service-wrapper text-center">
                    <div class="service-icon ">
                        {!! $s->code !!}
                    </div>
                    <div class="service-title">
                        <p>{{ $s->title }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section><!--service section end-->


<!--Our Plan section start-->
<section class="section-padding our-plan">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2 class="color-text">Our awesome plans</h2>
                    <p>{!! $page->plan_subtitle !!}</p>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($plan as $p)

                <div class="col-md-3 col-sm-6">
                    <div class="price-table text-center">
                        <div class="price-table-header">
                            <h4>{{ $p->name }}</h4>
                            <p>{{ $p->compound->name }} {{ $p->percent }}% for {{ $p->time }} times</p>
                        </div>
                        <div class="price-table-body">
                            <p> <span class="color-text">{{ $p->compound->name }}</span> Return</p>
                            <p>for <span class="color-text">{{ $p->time }}</span> times</p>
                            <p> <span class="color-text">{{ $p->percent }}%</span> roi each time</p>
                            <div class="price-range">
                                <div class="row">
                                    <div class="col-md-6 text-left col-sm-6 col-xs-6">
                                        <div class="min-price">
                                            <h6>Minimum<span class="color-text">{{ $basic->symbol }} {{ $p->minimum }}</span></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right col-sm-6 col-xs-6">
                                        <div class="min-price">
                                            <h6>Maximum<span class="color-text">{{ $basic->symbol }} {{ $p->maximum }}</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="invest-type__profit plan__value--{{ $p->id }}">
                                <input type="text" value="{{ $basic->symbol }} {{ ($p->minimum + $p->maximum) / 2 }}" class="custom-input invest-type__profit--val" data-slider=".slider-input--{{ $p->id }}">
                                <input type="hidden" name="amount" value="{{ ($p->minimum + $p->maximum) / 2 }}" class=" slider-input slider-input--{{ $p->id }}" data-perday="{{ $p->percent }}" data-peryear="{{ $p->time }}" data-min="{{ $p->minimum }}" data-max="{{ $p->maximum }}" data-dailyprofit=".daily-profit-{{ $p->id }}" data-totalprofit=".total-profit-{{ $p->id }} " data-valuetag=".plan__value--{{ $p->id }} .invest-type__profit--val"/>
                            </div>
                            <input type="hidden" name="plan_id" value="{{ $p->id }}">
                            <div class="price-range">
                                <div class="row">
                                    <div class="col-md-6 text-left col-sm-6 col-xs-6 invest-type__calc invest-type__calc--daily">
                                        <div class="min-price">
                                            <h6>per time<span class="color-text"><b class="daily-profit-{{ $p->id }}">{{ $basic->symbol }} {{ (($p->minimum + $p->maximum) / 2 ) * $p->percent /100 }}.0</b></span></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right col-sm-6 col-xs-6 invest-type__calc invest-type__calc--total">
                                        <div class="min-price">
                                            <h6>Total Return<span class="color-text"><b class="total-profit-{{ $p->id }}">{{ $basic->symbol }} {{ (((($p->minimum + $p->maximum) / 2) * $p->percent) /100 ) * $p->time }}.0</b></span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="price-table-footer">
                            <a href="{{ route('register') }}" class="boxed-btn">sign up</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row section-padding padding-bottom-0">
            <div class="col-md-6 col-sm-6">
                <div class="contact-info">
                    <div class="contact-title">
                        <h4>Have a question <span>we are here to help!</span></h4>
                    </div>
                    <div class="contact-details">
                        <p><i class="fa fa-phone"></i> {{ $basic->phone }}</p>
                        <p><i class="fa fa-envelope"></i> {{ $basic->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="discunt-text">
                    <h3>{{ $basic->reference_percent }}<i class="fa fa-percent"></i> <br /> referral <br /> commission</h3>
                </div>
            </div>
        </div>

    </div>
</section><!--Our Plan section end-->

<!--Project Done so far start-->
<section class="completed-projcets section-padding">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-sm-6">
                <div class="happy-clients-box">
                    <div class="happy-clients-icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="happy-clients-text">
                        <h4 class="counter" data-count="{{ $total_user }}">0 </h4>
                        <p>Total User</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="happy-clients-box">
                    <div class="happy-clients-icon">
                        <i class="fa fa-recycle"></i>
                    </div>
                    <div class="happy-clients-text">
                        <h4 class="counter" data-count="{{ $total_repeat }}" >0</h4>
                        <p>Total Repeat</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="happy-clients-box">
                    <div class="happy-clients-icon">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <div class="happy-clients-text">
                        <h4 class="counter" data-count="{{ $total_deposit }}">0 </h4>
                        <p>Total Deposit</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="happy-clients-box">
                    <div class="happy-clients-icon">
                        <i class="fa fa-cloud-upload"></i>
                    </div>
                    <div class="happy-clients-text">
                        <h4 class="counter" data-count="{{ $total_withdraw }}" >0 </h4>
                        <p>Total Withdraw</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Project Done so far end-->

<!--Our Top Investor Section Start-->
<section class="section-padding top-investor">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2 class="color-text">Our top Investors</h2>
                    <p>{{ $page->investor_subtitle }}</p>
                </div>
            </div>
        </div>
        <div class="row text-center">
            @foreach($top_investor as $key => $inv)
            <div class="col-md-3 col-sm-6">
                <div class="single-investor-wrapper @if($key % 2 != 0) color-onvestor @endif ">
                    <h4>{{ \App\User::findOrFail($inv->user_id)->name }}</h4>
                    <p>{{ $basic->symbol }} {{ $inv->total_invest }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section><!--Our Top Investor Section Start-->

<!--testimonial section start-->
<section class="section-padding  testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2 class="color-text">What People Say</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="slider-activation">
                    @foreach($testimonial as $tes)
                    <div class="testimonial-carousel">
                        <div class="single-testimonial-wrapper">
                            <div class="single-testimonial-top">
                                <div class="testimoanial-top-text">
                                    <div class="profile-pic">
                                        <img src="{{ asset('assets/images') }}/{{ $tes->image }}" class="img-circle img-responsive" alt="Client's Profile Pic">
                                    </div>
                                    <h4>{{ $tes->name }}<span>{{ $tes->position }}</span></h4>
                                </div>
                                <div class="testimonial-bottom">
                                    <p>{!! $tes->message !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section><!--testimonial section end-->

<!--Deopsit and Payouts section start-->
<section class="section-padding">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <div class="deposit-table">
                    <div class="deposit-title">
                        <h4>Latest Deposits</h4>
                    </div>
                    <div class="deposit-body">
                        <table class="table main-table">

                            <tbody>
                            <tr class="head">
                                <th>Name</th>
                                <th>Date</th>
                                <th>Currency</th>
                                <th>Amount</th>
                            </tr>
                            @foreach($latest_deposit as $ld)
                            <tr>
                                <td>{{ $ld->member->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($ld->created_at)->format('M d,Y') }}</td>
                                <td><strong>{{ $basic->currency }}</strong></td>
                                <td><strong>{{ $basic->symbol }}{{ $ld->amount }}</strong></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="deposit-table">
                    <div class="deposit-title">
                        <h4>Latest Withdraw</h4>
                    </div>
                    <div class="deposit-body">
                        <table class="table main-table">

                            <tbody>
                            <tr class="head">
                                <th>Name</th>
                                <th>Date</th>
                                <th>Currency</th>
                                <th>Amount</th>
                            </tr>
                            @foreach($latest_withdraw as $ld)
                                <tr>
                                    <td>{{ $ld->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($ld->created_at)->format('M d,Y') }}</td>
                                    <td><strong>{{ $basic->currency }}</strong></td>
                                    <td><strong>{{ $basic->symbol }}{{ $ld->amount }}</strong></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Deopsit and Payouts Section End-->

@endsection
@section('script')
    <script>
        $.each($('.slider-input'), function() {
            var $t = $(this),

                    from = $t.data('from'),
                    to = $t.data('to'),

                    $dailyProfit = $($t.data('dailyprofit')),
                    $totalProfit = $($t.data('totalprofit')),

                    $val = $($t.data('valuetag')),

                    perDay = $t.data('perday'),
                    perYear = $t.data('peryear');


            $t.ionRangeSlider({
                input_values_separator: ";",
                prefix: '{{ $basic->symbol }} ',
                hide_min_max: true,
                force_edges: true,
                onChange: function(val) {
                    $val.val( '{{ $basic->symbol }} ' + val.from);

                    var profit = (val.from * perDay / 100).toFixed(1);
                    profit  = '{{ $basic->symbol }} ' + profit.replace('.', '.') ;
                    $dailyProfit.text(profit) ;

                    profit = ( (val.from * perDay / 100)* perYear ).toFixed(1);
                    profit  =  '{{ $basic->symbol }} ' + profit.replace('.', '.');
                    $totalProfit.text(profit);

                }
            });
        });
        $('.invest-type__profit--val').on('change', function(e) {

            var slider = $($(this).data('slider')).data("ionRangeSlider");

            slider.update({
                from: $(this).val().replace('{{ $basic->symbol }} ', "")
            });
        })
    </script>
@endsection
