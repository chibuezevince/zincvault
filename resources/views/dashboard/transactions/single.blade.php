@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Transaction Details </h3>
                <table class="table table-bordered mb-0">
                    <thead class="thead-dark">
                      <tr>
                        <th>Item</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <tr>
                        <td>Transaction Type</td>
                        <td>{{$transaction->type}}</td>
                      </tr>
                      <tr>
                        <td>Currency</td>
                        <td class="text-capitalize">{{$transaction->currency}}</td>
                      </tr>
                      <tr>
                        <td>Amount</td>
                        <td>{{currencyLogo($transaction->currency)}}{{number_format($transaction->amount)}}</td>
                      </tr>
                      <tr>
                        <td>Alert Type</td>
                        <td>{{$transaction->cred_deb}}</td>
                      </tr>
                      @if($transaction->type =="Local Transfer" && $transaction->cred_deb=="Debit" && !isset($transaction->local_details['sender']))
                      <tr>
                        <td>Receiver Account Number</td>
                        <td>{{$transaction->local_details['receiver_account_number']}}</td>
                      </tr>
                      <tr>
                        <td>Receiver Name</td>
                        <td>{{getReceiverDetail($transaction->local_details['receiver_account_number'])->name}}</td>
                      </tr>
                      @elseif($transaction->type =="Local Transfer" && $transaction->cred_deb=="Credit" && !isset($transaction->local_details['sender']))
                      <tr>
                        <td>Sender Account Number</td>
                        <td>{{getSenderDetail($transaction->local_details['username'])->account_number}}</td>
                      </tr>
                      <tr>
                        <td>Sender Name</td>
                        <td>{{getSenderDetail($transaction->local_details['username'])->name}}</td>
                      </tr>
                      @elseif($transaction->type =="Local Transfer" && isset($transaction->local_details['sender']))
                      <tr>
                        <td colspan="2" class="text-center"><b>Transaction made by Adminstrator</b> </td>
                      </tr>
                      @endif
                      @if($transaction->type =="International Transfer")
                      <tr>
                        <td>Beneficiary Account Number</td>
                        <td>{{$transaction->inter_details['beneficiary_acc_num']}}</td>
                      </tr>
                      <tr>
                        <td>Beneficiary Name</td>
                        <td>{{$transaction->inter_details['beneficiary_name']}}</td>
                      </tr>
                      
                      <tr>
                        <td>Beneficiary Bank</td>
                        <td>{{$transaction->inter_details['beneficiary_bank']}}</td>
                      </tr>
                      <tr>
                        <td>Beneficiary Swift Code</td>
                        <td>{{$transaction->inter_details['beneficiary_swiftcode']}}</td>
                      </tr>
                      <tr>
                        <td>Beneficiary Routing Transit Number</td>
                        <td>{{$transaction->inter_details['routing_transit_no']}}</td>
                      </tr>
                      @endif
                      <tr>
                        <td>Reason</td>
                        <td>{{$transaction->reason}}</td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td class="status"><span class="badge @if($transaction->status==1)text-bg-success @elseif($transaction->status==2)text-bg-info @else text-bg-danger @endif">{{status($transaction->status)}}</span></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="text-center"><b>{{$transaction->time}}</b></td>
                      </tr>
                      <tr>
                      @if($transaction->type =="International Transfer" && user()->type==1)
                      <form action="{{route('admin.update_requests')}}" method="post" id="internationalStatus">
                      @if($transaction->status==2)
                        @csrf
                        <td class="text-center"><button class="btn btn-success" type="submit" name="approve" value="1">Approve Transaction</button></td>
                        <td class="text-center"><button class="btn btn-danger" type="submit" name="reject" value="1">Reject Transaction</button></td>
                      @elseif($transaction->status==1)
                      <td class="text-center"><button class="btn btn-danger" type="submit" name="reject" value="1">Reject Transaction</button></td>
                      <td class="text-center"><button class="btn btn-info" type="submit" name="pend" value="1">Pend Transaction</button></td>
                      @else
                      <td class="text-center"><button class="btn btn-success" type="submit" name="approve" value="1">Approve Transaction</button></td>
                      <td class="text-center"><button class="btn btn-info" type="submit" name="pend" value="1">Pend Transaction</button></td>
                      @endif
                      </form>
                      @endif
                      </tr>
                      <tr>
                        <td colspan="2" class="text-center">Generate Receipt <br>
                         <i id="pdf" class="material-icons p-5 cursor-pointer">picture_as_pdf</i><i id="print" class="material-icons cursor-pointer">print</i></td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
   $('#pdf').click(function (e) { 
        e.preventDefault();
        window.open('/dashboard/transaction/pdf/{{$transaction->transaction_id}}', '_blank'); 
    });
    $('#print').click(function (e) { 
        e.preventDefault();
        window.open('/dashboard/transaction/view/{{$transaction->transaction_id}}', '_blank'); 
    });
</script>
@if (session('success'))
<script>
iziToast.success({
    message: '{{session('success')}}',
    position: 'topRight',
});
</script>
@endif
@endsection