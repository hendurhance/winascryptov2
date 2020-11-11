@extends('layouts.dashboard')

@section('style')


    <style>
        /* ----------------------------------------------------------------
	Comments List
-----------------------------------------------------------------*/


        #comments {
            position: relative;
            margin-top: 50px;
            padding-top: 50px;
            border-top: 1px solid #EEE;
        }

        .commentlist {
            list-style: none;
            padding-bottom: 50px;
            margin: 0 0 50px;
            border-bottom: 1px solid #EEE;
        }

        #reviews .commentlist {
            padding-bottom: 30px;
            margin: 0 0 20px;
        }

        .commentlist ul { list-style: none; }

        .commentlist li,
        .commentlist li ul,
        .commentlist li ul li { margin: 30px 0 0 0; }

        .commentlist ul:first-child { margin-top: 0; }

        .commentlist li {
            position: relative;
            /*	margin: 30px 0 0 30px;*/
            margin: 30px 30px 30px 30px;
        }

        #reviews .commentlist li { margin-top: 20px; }

        .comment-wrap {
            position: relative;
            border: 1px solid #E5E5E5;
            border-radius: 5px;
            padding: 20px 20px 20px 35px;
        }

        .commentlist ul .comment-wrap {
            margin-left: 25px;
            padding-left: 20px;
        }

        #reviews .comment-wrap {
            border: 0;
            padding: 10px 0 0 35px;
        }

        .commentlist > li:first-child,
        #reviews .commentlist > li:first-child {
            padding-top: 0;
            margin-top: 0;
        }

        .commentlist li .children { margin-top: 0; }

        .commentlist li li .children { margin-left: 30px; }

        .commentlist li .comment-content,
        .pingback {
            position: relative;
            overflow: hidden;
        }

        .commentlist li .comment-content p,
        .pingback p { margin: 20px 0 0 0; }

        .commentlist li .comment-content { padding: 0 0 0 15px; }

        .commentlist li .comment-meta {
            float: left;
            margin-right: 0;
            line-height: 1;
        }

        .comment-avatar {
            position: absolute;
            top: 15px;
            left: -35px;
            padding: 4px;
            background: #FFF;
            border: 1px solid #E5E5E5;
            border-radius: 50%;
        }
        .comment-avatar2 {
            position: absolute;
            top: 15px;
            right: -35px;
            padding: 4px;
            background: #FFF;
            border: 1px solid #E5E5E5;
            border-radius: 50%;
        }

        .comment-avatar img {
            display: block;
            border-radius: 50%;
        }

        .commentlist li .children .comment-avatar { left: -25px; }

        .comment-content .comment-author {
            margin-bottom: -10px;
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        .comment-content .comment-author a {
            border: none;
            color: #333;
        }

        .comment-content .comment-author a:hover { color: #1ABC9C; }

        .comment-content .comment-author span { display: block; }

        .comment-content .comment-author span,
        .comment-content .comment-author span a {
            font-size: 12px;
            font-weight: normal;
            font-family: 'Crete Round', serif;
            font-style: italic;
            color: #AAA;
        }

        .comment-content .comment-author span a:hover { color: #888; }

        .comment-reply-link,
        .review-comment-ratings {
            display: block;
            position: absolute;
            top: 4px;
            left: auto;
            text-align: center;
            right: 0px;
            width: 14px;
            height: 14px;
            color: #CCC;
            font-size: 14px;
            line-height: 1;
        }

        .review-comment-ratings {
            width: auto;
            color: #333;
        }

        .comment-reply-link:hover { color: #888; }


        /* ----------------------------------------------------------------
            Comment Form
        -----------------------------------------------------------------*/


        #respond,
        #respond form { margin-bottom: 0; }

        .commentlist li #respond { margin: 30px 0 0; }

        .commentlist li li #respond { margin-left: 30px; }

        #respond p { margin: 10px 0 0 0; }

        #respond p:first-child { margin-top: 0; }

        #respond label small {
            color: #999;
            font-weight: normal;
        }

        #respond input[type="text"],
        #respond textarea { margin-bottom: 0; }

        #respond .col_one_third,
        #respond .col_full { margin-bottom: 20px; }

        .fb-comments,
        .fb_iframe_widget,
        .fb-comments > span,
        .fb_iframe_widget > span,
        .fb-comments > span > iframe,
        .fb_iframe_widget > span > iframe {
            display: block !important;
            width: 100% !important;
            margin: 0;
        }

    </style>

@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">




                    <div class="panel panel-primary">
                        <div class="panel-heading"> <strong style="color:#fff; font-size: 20px;">#{{ $support->ticket_number }} - {{ $support->subject }}
                                <span class="pull-right bold"><b class='btn btn-danger'>
                                    @if($support->status == 1)
                                         Opened
                                    @elseif($support->status == 2)
                                         Answered
                                    @elseif($support->status == 3)
                                        Customer Reply
                                    @elseif($support->status == 9)
                                         Closed
                                    @endif</b>
                                </span> </strong> </div>

                        <div class="panel-body">

                            <div class="row">


                                <div class="col-md-12 product-service md-margin-bottom-30">


                                    <ol class="commentlist noborder nomargin nopadding clearfix">

                                        @foreach($message as $m)
                                        @if($m->type == 1)

                                        <div class="row">
                                            <div class="col-md-10">

                                                <li class="comment even thread-even depth-1" id="li-comment-1">
                                                    <div id="comment-1" class="comment-wrap clearfix">
                                                        <div class="comment-meta">
                                                            <div class="comment-author vcard">
                                                                <span class="comment-avatar clearfix">
                                                                    <img alt="" src="@if($m->support->user->image == 'user-default.png') {{ asset('assets/images/user-default.png') }}@else {{ asset('assets/images') }}/{{ $m->support->user->image }}@endif" class="avatar avatar-60 photo avatar-default" width="60" height="60"></span>
                                                            </div>
                                                        </div>
                                                        <div class="comment-content clearfix">
                                                            <div class="comment-author">{{ $m->support->user->name }}<span>{{ \Carbon\Carbon::parse($m->created_at)->format('F dS, Y - h:i A') }}</span></div>
                                                            <p>{{ $m->message }}</p>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </li>

                                            </div>
                                        </div>
                                        @elseif($m->type == 2)
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-2">

                                                        <li class="comment even thread-even depth-1" id="li-comment-1">
                                                            <div id="comment-1" class="comment-wrap clearfix">
                                                                <div class="comment-meta">
                                                                    <div class="comment-author vcard">
                                                                <span class="comment-avatar clearfix">
                                                                    <img alt="" src="{{ asset('assets/images/logo.png') }}" class="avatar avatar-60 photo avatar-default" width="60" height="60"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content clearfix">
                                                                    <div class="comment-author">Admin<span>{{ \Carbon\Carbon::parse($m->created_at)->format('F dS, Y - h:i A') }}</span></div>
                                                                    <p>{{ $m->message }}</p>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </li>
                                                    </div>
                                                </div>

                                        @endif

                                        @endforeach

                                    </ol>


                                </div>
                                @if($support->status != 9)

                                <form action="{{ route('admin-support-message') }}" method="post" novalidate="">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="support_id" value="{{ $support->id }}">
                                    <div class="col-md-12 product-service md-margin-bottom-30">

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control input-lg" placeholder="Your Reply" required="" rows="4"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block"> SUBMIT </button>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger btn-lg btn-block btn-block delete_button"
                                                            data-toggle="modal" data-target="#DelModal">
                                                        <i class="fa fa-times"></i> Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                @endif

                            </div>
                        </div>
                    </div>



        </div>
    </div><!---ROW-->

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to Close This Support Ticket..?</strong>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route'=>['admin-support-close'],'id'=>'formSubmit','novalidate'=>'']) !!}
                    <input type="hidden" name="support_id" value="{{ $support->id }}">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" id="" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    {!! Form::close() !!}
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