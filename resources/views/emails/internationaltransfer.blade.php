@extends('emails.layouts.index')
@section('content')
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
  @if ($receiver=='user')
  <p id="details">Hello {{user()->name}}, an International Transfer occured in your account, Below are the details</p>   
  @elseif ($receiver=='user')
  <p id="details"> Hello Admin,  {{user()->name}} just made  an International Transfer, Below are the details</p>      
  @endif
                    <table id="customers">
                          <tr>
                            <th>Fields</th>
                            <th>Details</th>
                          </tr>
                          <tr>
                            <td>Amount</td>
                            <td>{{currencyLogo($data['currency'])}}{{InternationalAmount($data['amount'])}}</td>
                          </tr>
                          <tr>
                            <td>Beneficiary Name</td>
                            <td>{{$data['beneficiary_name']}}</td>
                          </tr>
                          <tr>
                            <td>Beneficiary Account Number</td>
                            <td>{{$data['beneficiary_acc_num']}}</td>
                          </tr>
                          <tr>
                            <td>Beneficiary Bank</td>
                            <td>{{$data['beneficiary_bank']}}</td>
                          </tr>
                      </table>
@endsection            