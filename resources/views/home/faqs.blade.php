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

    <!--faq page content start-->
    <section class="section-padding padding-top-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion-option">
                        <h3 class="title">General Questions</h3>

                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($faqs as $key => $f)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne{{ $f->id }}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#generalOne{{ $f->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        {{ $f->title }}
                                    </a>
                                </h4>
                            </div>
                            <div id="generalOne{{ $f->id }}" class="panel-collapse collapse {{ $key == 0 ? 'in' : '' }}" role="tabpanel" aria-labelledby="headingOne{{ $f->id }}">
                                <div class="panel-body">
                                    {!!  $f->description !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center">
                            {!! $faqs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
