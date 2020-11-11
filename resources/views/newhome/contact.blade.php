@extends('layouts.newfrontend')
@section('content')
    <!--header section start-->
    <section class="breadcrumb-section" style="background-image: url('{{ asset('assets/images/logo/bb.png') }}')">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- breadcrumb Section Start -->
            <div class="breadcrumb-content">
               <h5>{{ $page_title}}</h5>
            </div>
            <!-- Breadcrumb section End -->
          </div>
        </div>
      </div>
    </section>

  <!--Contact Section-->
<section class="contact-section contact-section1 section-padding section-background">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!--Contact Info Tabs-->
            <div class="contact-info">
                <div class="row ">
 <!-- contact-content Start -->
                                <div class="col-md-4">
                                  <div class="contact-content">
                                    <div class="contact-header contact-form">
                                      <h2>Get In Touch</h2>
                                    </div>
                                    <div class="contact-list">
                                      <ul>
                                        <li>
                                          <div class="contact-thumb"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                          <div class="contact-text">
                                            <p>Address:<span>{{ $basic->address }}</span></p>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="contact-thumb"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                          <div class="contact-text">
                                            <p>Call Us :<span>{{ $basic->phone }}</span></p>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="contact-thumb"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                          <div class="contact-text">
                                            <p>Mail Us :<span>{{ $basic->email }}</span></p>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <!-- contact-content End -->                               
                                <!--Form Column-->
                                <div class="form-column col-md-8 col-sm-12 ">
                                    <!-- Contact Form -->
                                    <div class="contact-form ">
                                        <h2>Send Message Us</h2>
                                       
                                            @if($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger alert-dismissable">

                                                        {{$error}}
                                                    </div>
                                                @endforeach
                                            @endif
                                        @if (session()->has('message'))
                                            <div class="alert alert-success alert-dismissable">

                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                      
                                       <form action="{{ route('contact-submit') }}" method="post">
                                    {!! csrf_field() !!}
                                            <div class="row clearfix">
                                                <div class="col-md-6  col-xs-12 form-group">
                                                    <input type="text" name="name" placeholder="Your Name*" required="">
                                                </div>
                
                                                <div class="col-md-6  col-xs-12 form-group">
                                                    <input type="email" name="email" placeholder="Email Address*" required="">
                                                </div>
                
                                                <div class=" col-md-12   form-group">
                                                    <textarea name="message" placeholder="Your Message..."></textarea>
                                                </div>
                
                                                <div class=" col-md-12 form-group">
                                                    <button class="theme-btn btn-style-one" type="submit" name="submit-form">Send Message</button>
                                                </div>
                
                                            </div>
                                        </form>
                
                        </div>
                  <!--End Comment Form -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--End Contact Section-->
    <!--Map Section-->
    <div class="map-section">
      <!--Map Outer-->
        <div class="map-outer">
            <div class="google-map" 
                id="contact-google-map" 
                data-map-lat="44.529688" 
                data-map-lng="-72.933009" 
                data-icon-path="assets/img/map-marker.png"
                data-map-title="Brooklyn, New York, United Kingdom" 
                data-map-zoom="14" 
                data-markers='{
                    "marker-1": [44.529688, -72.933009, "<h4>Head Office</h4><p>44/108 Brooklyn, UK</p>"],
                    "marker-2": [44.231172, -76.485954, "<h4>Branch Office</h4><p>4/99 Alabama, USA</p>"],
                    "marker-3": [44.999684, -69.070334, "<h4>Branch Office</h4><p>4/99 Maine, USA</p>"],
                    "marker-4": [40.880550, -77.393705, "<h4>Branch Office</h4><p>4/99 Pennsylvania, USA</p>"]
                }'>

        </div>

        </div>
    </div>
  <!--End Map Section--> 
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
@endsection
