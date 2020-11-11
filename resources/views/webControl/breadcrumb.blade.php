@extends('layouts.dashboard')
@section('style')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-photo"></i> <strong>{{ $page_title }}</strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption uppercase bold"><i class="fa fa-edit"></i> CHANGE Breadcrumb</div>
                                </div>
                                <div class="portlet-body">

                                    {!! Form::open(['files'=>true]) !!}

                                    <div class="row">

                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Change Breadcrumb</strong></label>
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new bold"> Change Breadcrumb </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="breadcrumb"> </span>
                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                    <code>Breadcrumb Mimes Type : png,jpeg,jpg | Resize 1280X560</code>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>

                                        <br>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-12"> <button type="submit" class="btn btn-primary bold btn-block"><i class="fa fa-send"></i> UPDATE</button></div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption uppercase bold"><i class="fa fa-photo"></i> Current Image</div>
                                </div>
                                <div class="portlet-body">
                                    <img class="img-responsive" src="{{ asset('assets/images') }}/{{ $basic->breadcrumb }}" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    @if (session('alert'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "{!! session('alert') !!}", "error");

            });

        </script>

    @endif

    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@endsection
