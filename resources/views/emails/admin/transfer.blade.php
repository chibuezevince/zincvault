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
 <p id="details"> Hello {{$user->name}}, you have a {{$type}} alert. <br> Below are the details: </p>   
                    <table id="customers">
                          <tr>
                            <th>Fields</th>
                            <th>Details</th>
                          </tr>
                         <tr>
                            <td>Amount</td>
                            <td>{{currencyLogo($data['currency'])}}{{number_format($data['amount'], 2)}}</td>
                         </tr>
                         <tr>
                            <td>Sender Name</td>
                            <td>Administrator</td>
                         </tr>
                         <tr>
                            <td>Current {{$data['currency']}} account balance</td>
                            <td>{{currencyLogo($data['currency'])}}{{number_format($balance, 2)}}</td>
                         </tr>
                      </table>
@endsection            