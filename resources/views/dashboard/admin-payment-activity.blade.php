@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">

      <div class="portlet light bordered">
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="depoist_request_table">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                             <th>Method</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=0;@endphp
                        @foreach($log as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                <td>{{ $p->custom }}</td>
                                <td>
                                    @if($p->payment_type == 1)
                                        <span class="label bold label-primary"><i class="fa fa-paypal"></i> Paypal</span>
                                    @elseif($p->payment_type == 2)
                                        <span class="label bold label-primary"><i class="fa fa-money"></i> Perfect Money</span>
                                    @elseif($p->payment_type == 3)
                                        <span class="label bold label-primary"><i class="fa fa-btc"></i> BTC - BlockChain</span>
                                    @elseif($p->payment_type == 4)
                                        <span class="label bold label-primary"><i class="fa fa-cc-stripe"></i> Credit Card</span>
                                    @elseif($p->payment_type == 5)
                                        <span class="label bold label-primary"><i class="fa fa-compass"></i> Coin Paymnet</span>
                                    @elseif($p->payment_type == 6)
                                        <span class="label bold label-primary"><i class="fa fa-money"></i> Skrill</span>
                                    @else
                                        <span class="label bold label-primary"><i class="fa fa-bank"></i> {{ $p->bank->name }}</span>
                                    @endif

                                </td>
                                <td>{{ $p->user->username }}</td>
                                <td>
                                    @if($p->status == 0)
                                        <span class="label bold label-warning"><i class="fa fa-spinner"></i> Waiting</span>
                                    @elseif($p->status == 1)
                                        <span class="label bold label-success"><i class="fa fa-check-square-o"></i> Complete</span>
                                    @elseif($p->status == 3)
                                        <span class="label bold label-danger"><i class="fa fa-times"></i> Cancel</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $p->amount }} - {{ $basic->currency }}
                                </td>
                                <td style="text-align: center;">
                                    @if($p->status == 0)
                                    <div class="btn-group btn-group-sm btn-group-solid">

                                    <button type="button" class="btn btn-sm purple delete_button" value="{{ $p->id }}" data-toggle="modal" href="#small" balance="{{$p->amount}}" status="1" user_id="{{$p->user->id}}"> <b>Approve</b></button>

                                     <button type="button" class="btn btn-sm btn-danger delete_button" value="{{ $p->id }}" data-toggle="modal" href="#small" status="2"><b>Cancel </b></button> </div>
                                    @else

                                    <a href="javascript:;" class="btn default blue-stripe"> <b> Not Available </b></a>

                                    @endif
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
    </div><!-- ROW-->


<!-- Modal Dialog -->
<div class="modal fade" id="small" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"> <b class="text-uppercase"> <span id="modal-heading">Deposit Request Cancel</span> </b></h4>
      </div>
      <div class="modal-body">
        <h5> <b>Are you sure about this ?</b></h5>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" id="confirm_delete" style="color:#fff">Yes</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="del_id">
<input type="hidden" id="balance">
<input type="hidden" id="status">
<input type="hidden" id="user_id">

@endsection
@section('scripts')
<script>

 $(document).ready(function() {

        $(document).on('click','.delete_button',function(){
    
                $("#del_id").val($(this).val());
                $("#balance").val($(this).attr('balance'))
                $("#status").val($(this).attr('status'));
                $("#user_id").val($(this).attr('user_id'));
                
                if($(this).attr('status')==1){
                    $('#modal-heading').text('Deposit Request Approve');
                    $('#confirm_delete').removeClass('btn-danger');
                    $('#confirm_delete').addClass('btn-success');
                }else{
                   $('#modal-heading').text('Deposit Request Cancel');
                   $('#confirm_delete').removeClass('btn-success');
                   $('#confirm_delete').addClass('btn-danger');
                }
           
          });   
                 
        $(document).on('click','#confirm_delete',function(){
              
            var id = $("#del_id").val();
            var amount = $("#balance").val(); 
            var status = $("#status").val(); 
            var uesr_id =  $("#user_id").val();
            var href = window.location.href.concat(' #depoist_request_table') ;    
            $.get("{{route('admin-payment-request-change')}}",{id,amount,status,uesr_id}, function(data){
              console.log(data);
                var href = window.location.href.concat(' #depoist_request_table') ;
                 $( "#depoist_request_table" ).load(href);
                 
                 if(status==1){
                    swal('Approve','Approve Successfully','success');
                 }else{
                    swal('Cancel','Cancel Successfully','error');
                 }
                 
            });  
        });
 });

</script>
@endsection
