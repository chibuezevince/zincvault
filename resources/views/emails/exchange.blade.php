@extends('emails.layouts.index')
@section('content')
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#details {
  font-family: Arial, Helvetica, sans-serif;
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
</style>
</head>
<body>

  <p id="details">Hello {{user()->name}}, An exchange transaction occured in your account. <br> Below are the details</p>
<table id="customers">
  <tr>
    <th>Item</th>
    <th>Detail</th>
  </tr>

  <tr>
    <td>Exchange from {{$exchange_details['currency_to']}}</td>
    <td>{{currencyLogo($exchange_details['currency_to'])}} {{$amount['exchange_amount']}}</td>
  </tr>

  <tr>
    <td>Exchange to {{$exchange_details['currency_from']}}</td>
    <td>{{currencyLogo($exchange_details['currency_from'])}} {{$amount['exchanged_amount']}}</td>
  </tr>

  <tr>
    <td>Date</td>
    <td>{{$date}}</td>
  </tr>

  {{-- <tr>
    <td>Account Exchanged To</td>
    <td>{{$exchange_details['currency_to']}}</td>
  </tr>

  <tr>
    <td>Account Exchanged From</td>
    <td>{{$exchange_details['currency_from']}}</td>
  </tr> --}}

  <tr>
    <td>Note</td>
    <td>{{$exchange_details['note']}}</td>
  </tr>
</table>

</body>
@endsection


