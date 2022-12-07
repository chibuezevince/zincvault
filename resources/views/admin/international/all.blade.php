@extends('admin.layouts.app')

@section('content')
            <div class="container-fluid">

                <!-- Title -->
                <h1 class="h2">
                    Transaction Log
                </h1>

                <div class="row">
                    <div class="col">

                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="w-150px min-w-150px">
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Name
                                                </a>
                                            </th>
                                            
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Time
                                                </a>
                                            </th>

                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Status
                                                </a>
                                            </th>

                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Amount
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    View Details
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="list">
                                        @if (transactionLogs(user()->username)->isEmpty())
                                           <tr>
                                           <td colspan="7" align="center">No transaction found</td> 
                                           </tr> 
                                        @else
                                        @foreach ($transactions as $log)
                                        <tr>
                                            <td class="currency"><span>{{getUser($log->username)->name}}</span></td>
                                            <td class="currency"><span>{{$log->time}}</span></td>
                                            <td class="date"><span class="badge @if($log->status==1)text-bg-success @elseif($log->status==2)text-bg-info @else text-bg-danger @endif">
                                                {{status($log->status)}}</span></td>
                                            <td>{{currencyLogo($log->currency)}} {{number_format($log->amount)}}</td>
                                            <td class="date"><a href="/dashboard/transaction/{{$log->transaction_id}}" target="_blank"><span class="badge badge-info">View</span></a></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- / .table-responsive -->
                            </div>
                                </div> <!-- / .row -->
                                
                                
                                <div class="mt-6 p-4">
                                    {{$transactions->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
@endsection