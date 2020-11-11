@extends('layouts.dashboard')

@section('content')

    @if(count($user))

        <div class="row">
            <div class="col-md-12">


                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Register At</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($user as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A') }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->username }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->phone }}</td>
                                    <td>
                                        {{ $p->balance }} - {{ $basic->currency }}
                                    </td>
                                    <td>
                                        @if($p->status == 0)
                                            <button type="button" class="btn btn-danger bold uppercase btn-sm block_button"
                                                    data-toggle="modal" data-target="#blockModal"
                                                    data-id="{{ $p->id }}">
                                                <i class='fa fa-times'></i> Block User
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary bold uppercase btn-sm block_button"
                                                    data-toggle="modal" data-target="#unblockModal"
                                                    data-id="{{ $p->id }}">
                                                <i class='fa fa-check'></i> Unblock User
                                            </button>
                                        @endif
                                            <a href="{{ route('user-details',$p->id) }}" class="btn  bold uppercase btn-success btn-sm"><i class="fa fa-eye"></i> View Details</a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $user->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- ROW-->

    @else

        <div class="text-center">
            <h3>No User Found</h3>
        </div>
    @endif

    <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-times'></i> Block User!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Block this user ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('block-user') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="unblockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-check'></i> Unblock User!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Unblock this user ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('unblock-user') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes Sure..!</button>
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

            $(document).on("click", '.block_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
        $(document).ready(function () {

            $(document).on("click", '.unblock_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>


@endsection

