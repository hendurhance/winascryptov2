@extends('layouts.dashboard')
@section('style')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">{{ $page_title }}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Present Logo</div>
                                <div class="panel-body">
                                    <img src="{{ asset('assets/images/logo/logo.png') }}" class="img-responsive" width="40%" height="30">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Present Icon</div>
                                <div class="panel-body">
                                    <img src="{{ asset('assets/images/logo/icon.png') }}" class="img-responsive" width="40%" height="30">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form role="form" method="POST" action="{{route('manage-logo')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                            <span> Upload New Logo </span>
                                            <input type="file" name="logo" class="form-control input-lg"> </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload New Icon </span>
                                                <input type="file" name="favicon" class="form-control input-lg">
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right col-md-12">
                                <button type="submit" class="btn blue btn-lg btn-block">Update</button>
                            </div>
                        </form>
                    </div>
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

    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@endsection
