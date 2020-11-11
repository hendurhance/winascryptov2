@extends('layouts.user-frontend.user-dashboard')
@section('content')
@include('layouts.breadcam')



    <div class="row">
        <div class="col-md-12">


            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Register Date</th>
                            <th>User Name</th>
                            <th>Username</th>
                            <th>User Email</th>
                            <th>User Phone</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=0;@endphp
                        @foreach($user as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->username }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->phone }}</td>
                                <td>
                                    @if($p->status == 1)
                                        <span class="label bold label-danger bold uppercase"><i class="fa fa-user-times"></i> Blocked</span>
                                    @else
                                        <span class="label bold label-success bold uppercase"><i class="fa fa-check"></i> Active</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div><!-- ROW-->



@endsection
