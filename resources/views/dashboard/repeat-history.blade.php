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
                    <table class="table table-striped table-bordered table-hover" id="samle_1">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Repeat Date Time</th>
                            <th>Transaction ID</th>
                            {{--<th>User Name</th>--}}
                            {{--<th>User Email</th>--}}
                            <th>Investment Plan</th>
                            <th>Investment Amount</th>
                            <th>Repeat Amount</th>
                            <th>Repeat Percentage</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=0;@endphp
                        @foreach($log as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                <td>{{ $p->trx_id }}</td>
                                {{--<td>{{ $p->user->username }}</td>--}}
                                {{--<td>{{ $p->user->email }}</td>--}}
                                <td>{{ $p->invest->plan->name }}</td>
                                <td>{{ $p->invest->amount }} - {{ $basic->currency }}</td>
                                <td>{{ $p->amount }} - {{ $basic->currency }}</td>
                                <td>{{ $p->invest->plan->percent }} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {!! $log->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->



@endsection
