@extends('layouts.user-frontend.user-dashboard')
@section('content')

@include('layouts.breadcam')

<div class="content_padding">
    <div class="container user-dashboard-body">
    <div class="row">
        <div class="login-admin login-admin1">
            <div class="login-header text-center">
                <h6>change password</h6>
            </div>
        
            <div class="col-md-6 col-md-offset-3">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                    <form action="" method="post" role="form">
                        {!! csrf_field() !!}
                    <input name="current_password" placeholder="Current Password" type="password">
                    <input name="password" placeholder="New Password" type="password">
                    <input name="password_confirmation" placeholder="New Password Again" type="password">
                    <button type="submit" class="new-btn-submit">Change Password</button>   
                    </form>
            </div>
        </div><!---ROW-->
    </div>
    </div>
</div>
@endsection

@section('script')
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

                swal("Sorry!", "{{ session('alert') }}", "error");

            });

        </script>

    @endif
@endsection
