@extends('layouts.dashboard')
@section('title', 'Slider')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Slider/Banner Settings</span>
                    </div>
                </div>
                <div class="portlet-body">
                     <form role="form" method="POST" action="{{route('slider.update')}}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             <img src="{{ asset('assets/images/slider') }}/{{$slide->image}}" class="img-responsive" width="100%">
                                <div class="form-group">
                                    <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Change Background Image </span>
                                                <input type="file" name="image" class="form-control input-lg">
                                            </span>
                                            <span class="btn-danger">Standard Image Size: 1920 x 900 px</span>
                                </div>
                                <div class="form-group">
                                    <label for="bold">Bold Text</label>
                                    <textarea class="form-control" id="bold" name="bold">
                                      {!! $slide->title !!}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="small">Small Text</label>
                                    <textarea class="form-control" id="small" name="small">
                                      {!! $slide->subtitle !!}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-block btn-success" >Update</button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>

@endsection
