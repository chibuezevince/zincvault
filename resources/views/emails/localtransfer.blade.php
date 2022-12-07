@extends('emails.layouts.index')
@section('content')
 <p id="details"> Hello   @if($type=="Debit"){{user()->name}}@else{{$receiver->name}}@endif, you have a {{$type}} alert. <br> Below are the details: </p>   
                    <table id="customers">
                          <tr>
                            <th>Fields</th>
                            <th>Details</th>
                          </tr>
                          <tr>
                            <td>Account Name</td>
                            <td> 
                                @if ($type=="Debit")
                                {{$receiver->name}}
                                @else 
                                {{user()->name}}
                                @endif
                             </td>
                          </tr>
                          <tr>
                            <td>Account Number</td>
                            <td>
                                @if ($type=="Debit")
                                {{$receiver->account_number}}
                                @else
                                {{user()->account_number}}
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <td>Amount</td>
                            @if ($type=="Debit")<td><span class="text-danger">{{currencyLogo($transfer_details['currency'])}}{{chargedAmount($transfer_details['amount'])}}</span></td>
                            @else
                            <td><span class="text-success">{{currencyLogo($transfer_details['currency'])}} {{$transfer_details['amount']}}</span></td>
                            @endif
                          </tr>
                          <tr>
                            <td>Reason</td>
                            <td>{{$transfer_details['reason']}}</td>
                          </tr>
                          <tr>
                            <td>Current {{$transfer_details['currency']}} balance <small>after transaction</small> </td>
                            <td> 
                              @if($transfer_details['currency']=="dollar")
                                @if ($type=="Debit")
                               <span class="text-danger">${{number_format(customer_details(user()->username)->dollar_balance, 2)}}</span>
                                @else
                                <span class="text-success">${{number_format($receiver_details->dollar_balance, 2)}}</span>
                                @endif
                              @elseif($transfer_details['currency']=="pound") 
                                @if ($type=="Debit")
                                <span class="text-danger">£{{number_format(customer_details(user()->username)->pound_balance, 2)}}</span>
                                 @else
                                 <span class="text-success">£{{number_format($receiver_details->pound_balance, 2)}}</span>
                                 @endif 
                              @else
                                @if ($type=="Debit")
                                <span class="text-danger">€{{number_format(customer_details(user()->username)->euro_balance , 2 )}}</span>
                                 @else
                                 <span class="text-success">€{{number_format($receiver_details->euro_balance, 2)}}</span>
                                 @endif 
                              @endif 
                            </td>
                          </tr>
                      </table>
@endsection            