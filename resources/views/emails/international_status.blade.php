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
  <p id="details">Hello {{getUser($details->username)->name}}, Your International Transfer has been {{$status}} </p>   
                    <table id="customers">
                          <tr>
                            <th>Fields</th>
                            <th>Details</th>
                          </tr>
                          <tr>
                            <td>Amount</td>
                            <td>{{currencyLogo($details->currency)}}{{InternationalAmount($details->amount)}}</td>
                          </tr>
                          <tr>
                            <td>Beneficiary Name</td>
                            <td>{{$details->inter_details['beneficiary_name']}} </td>
                          </tr>
                          <tr>
                            <td>Beneficiary Account Number</td>
                            <td>{{$details->inter_details['beneficiary_acc_num']}}</td>
                          </tr>
                          <tr>
                            <td>Beneficiary Bank</td>
                            <td>{{$details->inter_details['beneficiary_bank']}}</td>
                          </tr>
                          <tr>
                            <td>Date</td>
                            <td>{{$details->time}}</td>
                          </tr>
                      </table>
                      
                      <p id="details">Thank you for flying with us</p>
@endsection       