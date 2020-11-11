@extends('layouts.user-frontend.user-dashboard')

@section('style')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">

    <style>
        input[type="text"] {
            width: 100%;
        }

        input[type="email"] {
            wi
        }
    </style>
@endsection
@section('content')
@include('layouts.breadcam')

<div class="content_padding">
    <div class="container user-dashboard-body">
        
    <div class="row">
        <div class="login-admin login-admin1">
            <div class="login-header text-center">
                <h6>{!! $page_title  !!}</h6>
            </div>
             {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                <img style="width: 200px" src="{{ asset('assets/images') }}/{{ $user->image }}" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            
                            <div class="img-input-div">
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                     <div class="row">
                        <div class="col-md-6">
                                             <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Name :</strong></label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" id="" value="{{ $user->name }}"  required placeholder="Name">
                                        </div>
                                    </div>
                        </div>
                        <div class="col-md-6">
                                            <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">User Name :</strong></label>
                                        <div class="col-md-12">
                                            <input type="text" name="username" id="" value="{{ $user->username }}" required placeholder="Username">
                                        </div>
                                    </div>
                        </div>

                        <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-md-12"><strong style="text-transform: uppercase;">Email :</strong></label>
                                <div class="col-md-12">
                                    <input type="email" name="email" id="" value="{{ $user->email }}" required placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                    <label class="col-md-12"><strong style="text-transform: uppercase;">Phone :</strong></label>
                    <div class="col-md-12">
                        <input type="text" name="phone" id="" value="{{ $user->phone }}" required placeholder="Phone">
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="new-btn-submit"><i class="fa fa-send"></i> UPDATE PROFILE</button>
                    </div>
                </div>
            </div>
            
        </div> 
    </div>
    {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>

    @if (session('message'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Success!", "{{ session('message') }}", "success");

            });

        </script>

    @endif

    @if (session('alert'))

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "{!! session('alert') !!}", "error");

            });

        </script>

    @endif
@endsection
