@extends('layouts.dashboard')
@section('style')
    <script type="text/javascript" src="{{ asset('assets/admin/js/nicEdit-latest.js') }}"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><i class="fa fa-envelope"></i> Send Mail to - {{ $user->name }}</strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">

                    <form action="{{ route('user-email-submit') }}" method="post">

                        {!! csrf_field() !!}


                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="row uppercase">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>SUBJECT</strong></label>
                                    <div class="col-md-12">
                                        <input class="form-control input-lg" name="subject" placeholder="Email Subject"  type="text" required="">
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->

                        <br><br>

                        <div class="row uppercase">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Message</strong> NB: EMAIL WILL SENT USING EMAIL TEMPLATE</label>
                                    <div class="col-md-12">
                                        <textarea name="message" rows="10" class="form-control" id="area1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->

                        <br><br>
                        <div class="row uppercase">
                            <div class="col-md-12">

                                <button type="submit" class="btn btn-success btn-lg btn-block"> <i class="fa fa-send"></i> Send Mail</button>

                            </div>
                        </div><!-- row -->

                    </form>

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
@endsection