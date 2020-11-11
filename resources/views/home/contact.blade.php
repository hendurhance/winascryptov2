@extends('layouts.fontEnd')
@section('content')

    <!--header section start-->
    <section style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $page_title}}</h1>
                </div>
            </div>
        </div>
    </section><!--Header section end-->
    {!! $basic->google_map !!}
    <div class="map">
        {!! $basic->google_map !!}
    </div><!--Map section end-->
    <!--Contact Form Start-->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">

                                <div class="contact-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <h2 class="title">Send Your Message</h2>
                                <br>
                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            {!!  $error !!}
                                        </div>
                                    @endforeach
                                @endif
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <br>
                                <form action="{{ route('contact-submit') }}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="text" class="name" name="name" required placeholder="Name">
                                    <input type="email" class="email" name="email" required placeholder="Email">
                                    <br>
                                    <br>
                                    <input type="text" class="name" name="subject" required placeholder="Subject">
                                    <input type="text" class="email" name="phone" required placeholder="Phone Number">
                                    <textarea name="message" id="message" cols="30" rows="10" required placeholder="Message"></textarea>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Send Message Now!">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Contact Form end-->
    <!--get in touch section start-->
    <section class="get-in-touch section-padding text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Get In Touch</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 ">
                    <div class="single-shape-box">
                        <div class="get-in-tuch-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="get-in-touch-text">
                            <h4>Call Us</h4>
                            <p>{{ $basic->phone }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="single-shape-box color-onvestor">
                        <div class="get-in-tuch-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="get-in-touch-text">
                            <h4>Address </h4>
                            <p>{{ $basic->address }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="single-shape-box">
                        <div class="get-in-tuch-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="get-in-touch-text">
                            <h4>Email</h4>
                            <p>{{ $basic->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<!--Start of Tawk.to Script-->
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
          <!--End of Tawk.to Script-->