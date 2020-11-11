@extends('layouts.dashboard')

@section('style')

@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><i class="fa fa-info-circle"></i> {{ $page_title }}</strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">


                    {!! Form::model($page,['route'=>['update-subtitle',$page->id],'method'=>'put','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">About Sub Title</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="about_subtitle" class="form-control input-lg" rows="3" placeholder="About Sub Title" required>{{ $page->about_subtitle }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Service Sub Title</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="service_subtitle" class="form-control input-lg" rows="3" placeholder="Service Sub Title" required>{{ $page->service_subtitle }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Plan Sub Title</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="plan_subtitle" class="form-control input-lg" rows="3" placeholder="Plan Sub Title" required>{{ $page->plan_subtitle }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Investor Sub Title</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="investor_subtitle" class="form-control input-lg" rows="3" placeholder="Investor Sub Title" required>{{ $page->investor_subtitle }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn blue btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div><!---ROW-->


@endsection
@section('scripts')
    @if (session('alert'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "{!! session('alert') !!}", "error");

            });

        </script>

    @endif
@endsection
