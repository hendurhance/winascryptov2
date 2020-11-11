@extends('layouts.dashboard')
@section('title', 'Menu Show')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <a href="{{ route('menu-create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New Menu</a>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>

                <div class="portlet-body form">

                    <div class="row">
                        @foreach($menu as $m)
                        <div class="col-md-6">
                            <div class="text-center"><b>{{ $m->name }}</b></div>
                            <br>
                            <p class="text-center">
                                {!! $m->description !!}
                            </p>
                            <div class="col-md-6">
                                <a href="{{ route('menu-edit',$m->id) }}" class="btn blue btn-block margin-top-20"><i class="fa fa-edit"></i> Edit Menu </a>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger btn-block margin-top-20 delete_button"
                                        data-toggle="modal" data-target="#DelModal"
                                        data-id="{{ $m->id }}">
                                    <i class='fa fa-trash'></i> Delete Menu
                                </button>
                            </div>

                        </div>
                        @endforeach
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
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('menu-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">DELETE</button>
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

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

@endsection

