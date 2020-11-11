@extends('layouts.dashboard')
@section('title', 'What is Feature')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">What is section Settings</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addslide">
                            <i class="icon-plus"></i> New Feature
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        @php $i=1 @endphp
                        @foreach($features as $feature)
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Feature {{$i++}}</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                 <img src="{{ asset('assets/images/features') }}/{{$feature->photo}}" class="img-responsive" style="max-height:180px">
                                            </div>
                                            <div class="col-md-8">
                                                 <h3>
                                            {{$feature->title}}
                                        </h3>
                                        <p>
                                            {{$feature->description}}
                                        </p>
                                            </div>
                                        </div>
                                       
                                       
                                    </div>
                                    <div class="panel-footer">
                                        <a class="btn btn-circle btn-warning" data-toggle="modal" data-target="#editslide{{$feature->id}}">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <a class="btn btn-circle btn-danger"  href="{{ route('feature.destroy', $feature)}}" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Slide?">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Slide -->
                            <div id="editslide{{$feature->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit Slide {{$feature->id}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="POST" action="{{route('feature.update',$feature->id)}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{method_field('put')}}
                                                <div class="form-group">
                                    <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload Image </span>
                                                <input type="file" name="photo" class="form-control input-lg">
                                            </span>
                                                    <span class="btn-danger">Standard Image Size: 1440 x 750 px</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="{{$feature->title}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subtitle">Subtitle</label>
                                                    <input type="text" class="form-control" id="subtitle" name="description" value="{{$feature->description}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-success" >Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Slide -->
    <div id="addslide" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Slide</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('feature.store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload Image </span>
                                                <input type="file" name="photo" class="form-control input-lg">
                                            </span>
                            <span class="btn-danger">Standard Image Size: 1440 x 750 px</span>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" >
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="description" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-success" >Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

@endsection