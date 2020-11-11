@extends('layouts.newfrontend')
@section('style')

   <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/ranger-style.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.skinFlat.css') }}">
    <style>
       .price-table {
            margin-bottom: 45px;
            }
        .sale-content p{
            text-transform: none;
        }
        .sale-section{
            background-color: #121212 !important;
        }
   </style>
@endsection

@section('content')
    <!--Header section start-->
    <section class="header-area header-bg" style="background-image: url('{{ asset('assets/images/slider') }}/{{$slider_text->image}}')">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="header-section-wrapper">
                        <div class="header-section-top-part">
                            <div class="text-first">{!!$slider_text->title!!}</div>
                            <p style="font-size: 1.5em;" class=" wow slideInDown" data-wow-duration="2s">{!!$slider_text->subtitle!!}</p>
                        </div>
                        <div class="header-section-bottom-part">
                            <div class="domain-search-from">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Header section end-->
    <div class="clearfix"></div>
    <!-- Admin section start -->
    <div class="admin-section wow slideInDown" data-wow-duration="2s">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- admin content start -->
                    <div class="admin-content">
                        <!-- admin text start -->
                        <div class="admin-text">
                            <p>Get access to Your account</p>
                        </div>
                        <!-- admin text end -->
                        <!-- admin user start -->
                        <div class="admin-user">
                            <a href="{{url('login')}}"><button type="submit" name="login">sign in</button></a>
                            <a href="{{url('register')}}"><button type="submit" name="register">register now</button></a>
                        </div>
                        <!-- admin user end -->
                    </div>
                    <!-- admin-content end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Admin section end -->

    <!-- trading widget -->
    <section>
        <div class="trade-wid">
           <iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1505&invert_hover=" width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe>
        </div>
    </section>
    <!-- trading widget ends -->

    <div class="clearfix"></div>
    <!-- Circle Section Start -->
    <section  class="circle-section section-padding wow slideInUp" data-wow-duration="2s">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header">
                        <h2>HOW <span> {{ $basic_setting->title }} </span> Works </h2>
                        <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($features as $feature)
                    <div class="col-md-3">
                        <div class="circle-item wow flipInY" data-wow-duration="2s">
                            <img src="{{ asset('assets/images/features') }}/{{$feature->photo}}" alt="items">
                            <div class="circle-content">
                                <h6>{{$feature->title}}</h6>
                                <p>{{$feature->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Circle Section End -->
<div class="clearfix"></div>

<!--About community Section Start-->
<section class="section-padding sale-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <div class="sale-header wow slideInDown" data-wow-duration="2s">
                        <h2>about <span> {{ $site_title }} </span></h2>
                    </div>
                    <div class="sale-content">
                         <div class="row">
                            <div class="col-md-6 wow slideInLeft" data-wow-duration="2s">
                                <p class="about-community-text">
                                    {!! $page->about_leftText !!}
                                </p>
                            </div>
                            <div class="col-md-6 wow slideInRight" data-wow-duration="2s">
                                <p class="about-community-text text-justify">
                                    {!! $page->about_rightText !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About community Section end-->
<div class="clearfix"></div>
<!--service section start-->
<section class="service-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center section-padding padding-bottom-0 wow slideInUp" data-wow-duration="2s">
                    <div class="section-header">
                        <h2>Our <span>Services</span></h2>
                        <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
                    </div>
                    <p>{!! $page->service_subtitle !!}</p>
                </div>
            </div>
        </div>
        <div class="row wow slideInUp" data-wow-duration="2s">
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
</section>
<!--service section end-->

    <!--start investment plan-->
    <section class="section-background">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center section-padding padding-bottom-0 wow slideInUp" data-wow-duration="2s">
                        <div class="section-header">
                            <h2>Our awesome <span> plans</span></h2>
                            <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
                        </div>
                        <p>{!! $page->plan_subtitle !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($plan as $p)
                    <div class="col-md-4 col-sm-6 pricing-list-botom-margin wow zoomIn" data-wow-duration="3s">
                        <!-- Pricing  List1 Start -->
                        <div class="pricing-list1">
                            <div class="pricing-header1">
                                <h5>{{ $p->name }}</h5>
                                <p>{{ $p->compound->name }} {{ $p->percent }}% for {{ $p->time }} times</p>
                            </div>
                            <div class="pricing-info1">
                                <ul>
                                    <li> <p>for <span class="color-text">{{ $p->time }}</span> times</p></li>
                                    <li><p> <span class="color-text">{{ $p->percent }}%</span> roi each time</p></li>
                                </ul>
                            </div>
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
                                <input type="text" value="{{ $basic->symbol }} {{ ($p->minimum + $p->maximum) / 2 }}" class="custom-input invest-type__profit--val" data-slider=".slider-input--{{ $p->id }}" style="color:#FFF; font-size: 25px">
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

                            <!--<a href="pricing-list.html">Order Now!</a>-->
                        </div>
                        <!-- Pricing List1 End -->
                    </div>
            @endforeach
            </div>
        <div class="row section-padding padding-bottom-0">
            <div class="col-md-6 col-sm-6">
                <div class="contact-middel-info wow bounceInLeft" data-wow-duration="2s">
                    <div class="contact-middel-title">
                        <h4>Have a question <span>we are here to help!</span></h4>
                    </div>
                    <div class="contact-middel-details">
                        <p><i class="fa fa-phone"></i> {{ $basic->phone }}</p>
                        <p><i class="fa fa-envelope"></i> {{ $basic->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="discunt-middel-text wow bounceInRight" data-wow-duration="2s">
                    <h3>{{ $basic->reference_percent }}<i class="fa fa-percent"></i> <br /> referral <br /> commission</h3>
                </div>
            </div>
        </div>
        </div>
</section>
<!--end start investment plan-->
<!--Our Top Investor Section Start-->
<div class="clearfix"></div>
<section class="commission-section section-padding ">
    <div class="container">
      <!-- section header start -->
          <div class="section-header wow slideInUp" data-wow-duration="2s">
            <h2>Our top <span> Investors</span></h2>
            <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
          </div>
           <p class="margin-b-35 wow slideInRight" data-wow-duration="2s">{{ $page->investor_subtitle }}</p>
        <!-- section header end -->
      <div class="row">
        @php $i=1 @endphp
        @foreach($top_investor as $key => $inv)
        <div class="col-md-3">
          <div class="referral-amount wow zoomIn" data-wow-duration="3s">
            <p>{{ \App\User::findOrFail($inv->user_id)->name }}</p>
            <h4><span> {{ $basic->symbol }} </span>{{ number_format($inv->total_invest) }}</h4>
            <h5>{{$i++}}</h5>
          </div>
        </div>
            @endforeach
      </div>
    </div>
  </section>
<!--Our Top Investor Section Start-->

<div class="clearfix"></div>
<!--staticies sectioin-->
<!-- <section class="sale-section section-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="counter-list wow shake" data-wow-duration="2s">
              <div class="counter-item">
                <div class="counter-thumb"><i class="fa fa-user"></i><p class="counter">{{ $total_user }}</p></div>
                  <div class="counter-content">
                      <p>Total User</p>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="counter-list wow shake" data-wow-duration="2s" data-wow-delay="2s">
              <div class="counter-item">
                <div class="counter-thumb"> <i class="fa fa-recycle"></i><p class="counter">{{ $total_repeat }}</p></div>
                  <div class="counter-content">
                   <p>Total Repeat</p>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="counter-list wow shake" data-wow-duration="2s" data-wow-delay="4s">
              <div class="counter-item">
                <div class="counter-thumb"> <i class="fa fa-cloud-download"></i><p class="counter">{{ $total_deposit }}</p></div>
                  <div class="counter-content">
                     <p>Total Deposit</p>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="counter-list wow shake" data-wow-duration="2s" data-wow-delay="6s">
              <div class="counter-item">
                <div class="counter-thumb"><i class="fa fa-cloud-upload"></i><p class="counter">{{ $total_withdraw }}</p></div>
                  <div class="counter-content">
                    <p>Total Withdraw</p>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
 </section> -->
<!--staticies sectioin end-->
<div class="clearfix"></div>
<!--testimonial section start-->
    <section class="people-say-section section-padding">
      <div class="container">
       <div class="row">
        <div class="col-md-12">
          <!-- section header start -->
          <div class="section-header wow bounceInUp" data-wow-duration="2s">
            <h2>What People <span>Say</span> </h2>
           <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
          </div>
        <!-- section header end -->
        </div>
      </div>
        <div class="row">
          <div class="col-md-12">   

              <div class="testimonial-area">
                <div class="row">
                    <div class="col-lg-12  col-md-10 ">
                      <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-2">
                          <div class="testimonial-image-slider slider-nav text-center">
                          @foreach($testimonial as $tes)    
                            <div class="sin-testiImage wow rotateIn" data-wow-duration="2s">
                              <img src="{{ asset('assets/images') }}/{{ $tes->image }}" alt="slider">
                            </div>
                         @endforeach
                          </div>
                        </div>
                  </div>
                      </div> 

                </div>  
                  <div class="row">
                  <div class="col-md-12 ">
                      <div class="testimonial-text-slider slider-for text-center wow bounceInRight" data-wow-duration="2s">
                         @foreach($testimonial as $tes)    
                            <div class="sin-testiText">
                                 <!-- people sat content list start -->
                                  <div class="people-say-content-list  " >
                                    <h4>{{ $tes->name }}</h4>

                                    <h6>{{ $tes->position }}</h6>
                                    <ul>
                                        <li>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                        </li>
                                    </ul>
                                    <p>
                                        {!! $tes->message !!} 
                                    </p>
                                  </div>
                                  <!-- people-say-content-list end -->
                            </div>
                     @endforeach    
                        </div> 
                  </div>
                  </div>
                </div>
              </div>

          </div>

        </div><!-- row -->
    </section><!--  section -->
<!--testimonial section start-->
<div class="clearfix"></div>
 <!--Deopsit and Payouts section start-->
<!-- <section class="hosting-section hosting-section1  section-padding section-background">
      <div class="container">
                  <div class="row">
        <div class="col-md-12">
          <div class="section-header wow bounceInDown" data-wow-duration="3s">
            <h2>Latest <span> Deposits & Withdraw</span></h2>
             <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
              <div class="section-wrapper wow bounceInLeft" data-wow-duration="2s">
                 <div class="deposit-title text-center">
                        <h4>Latest Deposits</h4>
                    </div>
                <div class="hosting-content table-responsive">
                  <table>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Currency</th>
                         <th>Amount</th>
                      </tr>
                      
                    </thead>
                    <tbody>
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
              <div class="section-wrapper wow bounceInRight" data-wow-duration="2s">
                  <div class="deposit-title text-center">
                        <h4>Latest Withdraw</h4>
                    </div>
                <div class="hosting-content table-responsive">
                  <table>
                    <thead>
                      <tr>
                         <th>Name</th>
                         <th>Date</th>
                         <th>Currency</th>
                         <th>Amount</th>
                      </tr>
                      
                    </thead>
                    <tbody>
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
    </section> -->
<!--Deopsit and Payouts Section End-->
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/ion.rangeSlider.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: true,
                live: true
            });
            wow.init();
        });
    </script>
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f9d52fa16ea1756a6df1823/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
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