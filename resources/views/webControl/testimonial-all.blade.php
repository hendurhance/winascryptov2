@extends('layouts.dashboard')
@section('content')


    <div class="row">
        <div class="col-md-12">


            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="samaple_1">
                        <colgroup>
                            <col class="col-xs-0">
                            <col class="col-xs-0">
                            <col class="col-xs-0">
                            <col class="col-xs-0">
                            <col class="col-xs-0">
                            <col class="col-xs-3">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Author Name</th>
                            <th>Author Details</th>
                            <th>Author Image</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=0;@endphp
                        @foreach($testimonial as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->details }}</td>
                                <td>
                                    <img style="width: 100px" class="img-responsive" src="{{ asset('assets/images') }}/{{ $p->image }}">
                                </td>
                                <td>{!! $p->message !!}</td>
                                <td>
                                    <a href="{{ route('testimonial-edit',$p->id) }}" class="btn btn-primary bold uppercase"><i class="fa fa-edit"></i> Edit </a>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#DelModal"
                                            data-id="{{ $p->id }}">
                                        <i class='fa fa-trash'></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div><!-- ROW-->

    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('testimonial-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>

@endsection
