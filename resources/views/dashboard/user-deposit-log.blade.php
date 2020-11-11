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
                    <table class="table table-striped table-bordered table-hover" id="sample_1">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Deposit Date</th>
                            <th>Transaction ID</th>
                            <th>Deposit Method</th>
                            <th>Send Amount</th>
                            <th>Deposit Charge</th>
                            <th>Deposit Balance</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=0;@endphp
                        @foreach($deposit as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                <td>{{ $p->transaction_id }}</td>
                                <td>
                                    @if($p->payment_type == 1)
                                        <span class="label bold label-primary"><i class="fa fa-paypal"></i> Paypal</span>
                                    @elseif($p->payment_type == 2)
                                        <span class="label bold label-primary"><i class="fa fa-money"></i> Perfect Money</span>
                                    @elseif($p->payment_type == 3)
                                        <span class="label bold label-primary"><i class="fa fa-btc"></i> BTC - BlockChain</span>
                                    @elseif($p->payment_type == 4)
                                        <span class="label bold label-primary"><i class="fa fa-credit-card"></i> Credit Card</span>
                                    @else
                                        <span class="label bold label-primary"><i class="fa fa-bank"></i> {{ $p->bank->name }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4)
                                        {{ $p->net_amount }} - USD
                                    @else
                                        {{ $p->net_amount }} - {{ $basic->currency }}
                                    @endif
                                </td>
                                <td>
                                    @if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4)
                                        {{ $p->charge }} - USD
                                    @else
                                        {{ $p->charge }} - {{ $basic->currency }}
                                    @endif
                                </td>
                                <td>
                                    @if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4)
                                        {{ $p->amount }} - {{ $basic->currency }}
                                    @else
                                        {{ $p->amount }} - {{ $basic->currency }}
                                    @endif
                                </td>
                                <td>
                                    @if($p->status == 1)
                                        <span class="label bold label-primary"><i class="fa fa-check"></i> Completed</span>
                                    @elseif($p->status == 0)
                                        <span class="label bold label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                    @elseif($p->status == 2)
                                        <span class="label bold label-danger"><i class="fa fa-times"></i> Cancel</span>
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
