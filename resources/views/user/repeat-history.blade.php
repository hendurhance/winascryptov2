@extends('layouts.user-frontend.user-dashboard')
@section('content')
@include('layouts.breadcam')

<div class="content_padding">
    <div class="container user-dashboard-body">
    
  

    <div class="row">
            <div class="col-md-12">
            
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                         <div class="admin-header-text">  
                           <h3> Investment repeat history</h3>
                        </div>
                        
                    </div>    
                    <div class="panel-body table-responsive">
                         <table class="table table-striped table-bordered table-hover" id="sample_1">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Repeat Date Time</th>
                            <th>Transaction ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
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
                                <td>{{ $p->user->username }}</td>
                                <td>{{ $p->user->email }}</td>
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
        </div>
  </div>
</div>        
@endsection
