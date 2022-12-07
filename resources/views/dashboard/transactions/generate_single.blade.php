<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #00bac7;
  color: white;
}
#details {
    font-family: Arial, Helvetica, sans-serif;
    text-align: center
  }
</style>
</head>
<body>
<div align="center">
  {{-- <img src="{{settings()}}" alt="" width="70px"><br> --}}
</div>
<h3 id="details">Transaction Detail</h3>

<table class="" id="customers">
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
        <td colspan="2" class="text-center" align="center"><b>Transaction made by Adminstrator</b> </td>
      </tr>
      @endif
      <tr>
        <td>Reason</td>
        <td>{{$transaction->reason}}</td>
      </tr>
      <tr>
        <td>Status</td>
        <td class="status"><span class="badge @if($transaction->status)text-bg-success @else text-bg-danger @endif">{{status($transaction->status)}}</span></td>
      </tr>
      <tr align="center">
        <td colspan="2" class="text-center"><b>{{$transaction->time}}</b></td>
      </tr>
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
    window.onafterprint = window.close;
    window.print();
  });
</script>
</body>
</html>


