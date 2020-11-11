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
                           <h3> Withdraw history</h3>
                        </div>
                        
                    </div>    
                    <div class="panel-body table-responsive">
<table class="table table-striped table-bordered table-hover" id="sample_1">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Post Balance</th>
                            <th>Details</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=0;@endphp
                        @foreach($log as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                <td>{{ $p->transaction_id }}</td>
                                <td>
                                    @if($p->amount_type == 1)
                                        <span class="label bold label-primary"><i class="fa fa-cloud-download"></i> Deposit</span>
                                    @elseif($p->amount_type == 2)
                                        <span class="label bold label-danger"><i class="fa fa-minus"></i> Active</span>
                                    @elseif($p->amount_type == 3)
                                        <span class="label bold label-success"><i class="fa fa-plus"></i> Reference</span>
                                    @elseif($p->amount_type == 4)
                                        <span class="label bold label-success"><i class="fa fa-exchange"></i> Repeat</span>
                                    @elseif($p->amount_type == 5)
                                        <span class="label bold label-primary"><i class="fa fa-cloud-upload"></i> Withdraw</span>
                                    @elseif($p->amount_type == 6)
                                        <span class="label bold label-warning"><i class="fa fa-cloud-download"></i> Refund</span>
                                    @elseif($p->amount_type == 8)
                                        <span class="label bold label-success"><i class="fa fa-plus"></i> Add </span>
                                    @elseif($p->amount_type == 9)
                                        <span class="label bold label-danger"><i class="fa fa-minus"></i> Subtract </span>
                                    @elseif($p->amount_type == 10)
                                        <span class="label bold label-danger"><i class="fa fa-bolt"></i> Charge </span>
                                    @elseif($p->amount_type == 15)
                                        <span class="label bold label-success"><i class="fa fa-recycle"></i> Repeat </span>
                                    @elseif($p->amount_type == 14)
                                        <span class="label bold label-success"><i class="fa fa-cloud-upload"></i> Invest </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $p->amount }} - {{ $basic->currency }}
                                </td>
                                <td>
                                    {{ $p->post_bal }} - {{ $basic->currency }}
                                </td>
                                <td>
                                    {{ $p->description }}
                                </td>
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
