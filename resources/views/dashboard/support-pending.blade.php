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
                                <th>Date</th>
                                <th>Ticket Number</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($support as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A') }}</td>
                                    <td>{{ $p->ticket_number }}</td>
                                    <td>{{ $p->subject }}</td>
                                    <td>
                                        @if($p->status == 1)
                                            <span class="label label-info"> Opened</span>
                                        @elseif($p->status == 2)
                                            <span class="label label-success"> Answered</span>
                                        @elseif($p->status == 3)
                                            <span class="label bg-purple bg-font-purple"> Customer Reply</span>
                                        @elseif($p->status == 9)
                                            <span class="label label-danger"> Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin-support-mess',$p->ticket_number) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
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
@section('scripts')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


@endsection

