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
                    <table class="table table-striped table-bordered table-hover">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Request Date</th>
                            <th>Transaction ID</th>
                            <th>User Name</th>
                            {{--<th>Email</th>--}}
                            <th>Deposit Method</th>
                            <th>Deposit Balance</th>
                            <th>Deposit Charge</th>
                            <th>Net Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=0;@endphp
                        @foreach($deposit as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                <td>#{{ $p->transaction_id }}</td>
                                <td>{{ $p->member->username }}</td>
{{--                                <td>{{ $p->member->email }}</td>--}}
                                <td>
                                    @if($p->payment_type == 1)
                                        <span class="label label-primary"><i class="fa fa-paypal"></i> Paypal</span>
                                    @elseif($p->payment_type == 2)
                                        <span class="label label-primary"><i class="fa fa-money"></i> Perfect Money</span>
                                    @elseif($p->payment_type == 3)
                                        <span class="label label-primary"><i class="fa fa-btc"></i> BTC - BlockChain</span>
                                    @elseif($p->payment_type == 4)
                                        <span class="label label-primary"><i class="fa fa-credit-card"></i> Credit Card</span>
                                    @else
                                        <span class="label label-primary bold"><i class="fa fa-bank"></i> {{ $p->bank->name }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4)
                                        {{ $p->amount }} - USD
                                    @else
                                        {{ $p->amount }} - {{ $basic->currency }}
                                    @endif
                                </td>
                                <td>
                                    @if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4)
                                        {{ $p->charge }} - USD
                                    @else
                                        {{ $p->charge }} - {{ $basic->currency }}
                                    @endif
                                </td>
                                <td>{{ $p->net_amount }} - {{ $basic->currency }}</td>

                                   
                                 <td>
                                    @if($p->status == 1)
                                        <span class="label label-primary bold uppercase"><i class="fa fa-check"></i> Approved</span>
                                    @elseif($p->status == 2)
                                            <span class="label label-danger bold uppercase"><i class="fa fa-times"></i> Cancel</span>
                                     @elseif($p->status == 0)
                                            <span class="label label-warning bold uppercase"><i class="fa fa-spinner"></i> Pending</span>
                                    @endif

                                   
                                    </td>
                                <td>
                                    <a href="{{ route('request-view',$p->id) }}" class="btn btn-sm btn-primary bold uppercase"><i class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="text-center">
                        {!! $deposit->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> <strong>Confirmation..!</strong></h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you Want to Approve This Deposit Request..?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-deposit-approve') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes. I am Sure.</button>
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
