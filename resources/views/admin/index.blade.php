@extends('admin.layouts.app')

@section('content')
            <div class="container-fluid">

                <!-- Title -->
                <h1 class="h2">
                    Administrator Dashboard
                </h1>
                
                <div class="row">
                    <div class="col-xxl-5">
                        <div class="row">
                            <div class="col-md-6">

                                <!-- Card -->
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col d-flex justify-content-between">
        
                                                <div>
                                                    <!-- Title -->
                                                    <h5 class="d-flex align-items-center text-uppercase text-muted fw-semibold mb-2">
                                                        <span class="legend-circle-sm bg-success"></span>
                                                        Active Users
                                                    </h5>
        
                                                    <!-- Subtitle -->
                                                    <h2 class="mb-0">
                                                        {{count(is_active(1))}}
                                                    </h2>
        
                                                    <!-- Comment -->
                                                    {{-- <p class="fs-6 text-muted mb-0">
                                                        No additional income
                                                    </p> --}}
                                                </div>
        
                                                <span class="text-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32"><defs><style>.a{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;}</style></defs><title>cash-briefcase</title><path class="a" d="M9.75,15.937c0,.932,1.007,1.688,2.25,1.688s2.25-.756,2.25-1.688S13.243,14.25,12,14.25s-2.25-.756-2.25-1.688,1.007-1.687,2.25-1.687,2.25.755,2.25,1.687"/><line class="a" x1="12" y1="9.75" x2="12" y2="10.875"/><line class="a" x1="12" y1="17.625" x2="12" y2="18.75"/><rect class="a" x="1.5" y="6.75" width="21" height="15" rx="1.5" ry="1.5"/><path class="a" d="M15.342,3.275A1.5,1.5,0,0,0,13.919,2.25H10.081A1.5,1.5,0,0,0,8.658,3.275L7.5,6.75h9Z"/></svg>
                                                </span>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <!-- Card -->
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col d-flex justify-content-between">
        
                                                <div>
                                                    <!-- Title -->
                                                    <h5 class="d-flex align-items-center text-uppercase text-muted fw-semibold mb-2">
                                                        <span class="legend-circle-sm bg-danger"></span>
                                                        Inactive Users
                                                    </h5>
        
                                                    <!-- Subtitle -->
                                                    <h2 class="mb-0">
                                                        {{count(is_active(0))}}
                                                    </h2>
                                                </div>
        
                                                <span class="text-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32"><defs><style>.a{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;}</style></defs><title>cash-briefcase</title><path class="a" d="M9.75,15.937c0,.932,1.007,1.688,2.25,1.688s2.25-.756,2.25-1.688S13.243,14.25,12,14.25s-2.25-.756-2.25-1.688,1.007-1.687,2.25-1.687,2.25.755,2.25,1.687"/><line class="a" x1="12" y1="9.75" x2="12" y2="10.875"/><line class="a" x1="12" y1="17.625" x2="12" y2="18.75"/><rect class="a" x="1.5" y="6.75" width="21" height="15" rx="1.5" ry="1.5"/><path class="a" d="M15.342,3.275A1.5,1.5,0,0,0,13.919,2.25H10.081A1.5,1.5,0,0,0,8.658,3.275L7.5,6.75h9Z"/></svg>
                                                </span>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <!-- Card -->
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col d-flex justify-content-between">
        
                                                <div>
                                                    <!-- Title -->
                                                    <h5 class="d-flex align-items-center text-uppercase text-muted fw-semibold mb-2">
                                                        <span class="legend-circle-sm bg-success"></span>
                                                        Pending Transfer Requests
                                                    </h5>
        
                                                    <!-- Subtitle -->
                                                    <h2 class="mb-0">
                                                        {{count(wireTransferRequests())}}
                                                    </h2>
                                                </div>
        
                                                <span class="text-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32"><defs><style>.a{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;}</style></defs><title>cash-briefcase</title><path class="a" d="M9.75,15.937c0,.932,1.007,1.688,2.25,1.688s2.25-.756,2.25-1.688S13.243,14.25,12,14.25s-2.25-.756-2.25-1.688,1.007-1.687,2.25-1.687,2.25.755,2.25,1.687"/><line class="a" x1="12" y1="9.75" x2="12" y2="10.875"/><line class="a" x1="12" y1="17.625" x2="12" y2="18.75"/><rect class="a" x="1.5" y="6.75" width="21" height="15" rx="1.5" ry="1.5"/><path class="a" d="M15.342,3.275A1.5,1.5,0,0,0,13.919,2.25H10.081A1.5,1.5,0,0,0,8.658,3.275L7.5,6.75h9Z"/></svg>
                                                </span>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">

                                <!-- Card -->
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col d-flex justify-content-between">
        
                                                <div>
                                                    <!-- Title -->
                                                    <h5 class="d-flex align-items-center text-uppercase text-muted fw-semibold mb-2">
                                                        <span class="legend-circle-sm bg-success"></span>
                                                        Pound Account Balance
                                                    </h5>
        
                                                    <!-- Subtitle -->
                                                    <h2 class="mb-0">
                                                        £{{number_format(user_details()->pound_balance, 2)}}
                                                    </h2>
        
                                                    <!-- Comment -->
                                                    <p class="fs-6 text-muted mb-0">
                                                            @if (transaction_log('Debit', 'pound'))
                                                               <span class="text-danger"> - £{{number_format(transaction_log('Debit', 'pound')->amount, 2)}}</span>&nbsp;
                                                            @endif    
                                                            @if(transaction_log('Credit', 'pound'))
                                                           <span class="text-success"> + £{{number_format(transaction_log('Credit', 'pound')->amount, 2)}}</span>
                                                            @endif  
                                                        </p>
                                                </div>
        
                                                <span class="text-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32"><defs><style>.a{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;}</style></defs><title>cash-briefcase</title><path class="a" d="M9.75,15.937c0,.932,1.007,1.688,2.25,1.688s2.25-.756,2.25-1.688S13.243,14.25,12,14.25s-2.25-.756-2.25-1.688,1.007-1.687,2.25-1.687,2.25.755,2.25,1.687"/><line class="a" x1="12" y1="9.75" x2="12" y2="10.875"/><line class="a" x1="12" y1="17.625" x2="12" y2="18.75"/><rect class="a" x="1.5" y="6.75" width="21" height="15" rx="1.5" ry="1.5"/><path class="a" d="M15.342,3.275A1.5,1.5,0,0,0,13.919,2.25H10.081A1.5,1.5,0,0,0,8.658,3.275L7.5,6.75h9Z"/></svg>
                                                </span>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>    --}}
                        </div> <!-- / .row -->
                    </div>
                </div> <!-- / .row -->

                <div class="row">
                    <div class="col">

                        <!-- Card -->
                        <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "email", "id", {"name": "date", "attr": "data-signed"}, "status"], "page": 8}' id="users">
                            <div class="card-header border-0 card-header-space-between">

                                <!-- Title -->
                                <h2 class="card-header-title h4 text-uppercase">
                                    recent transactions
                                </h2>

                                <!-- Dropdown -->
                                <div class="dropdown ms-4">
                                    <a href="javascript: void(0);" class="dropdown-toggle no-arrow text-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14"><g><circle cx="12" cy="3.25" r="3.25" style="fill: currentColor"/><circle cx="12" cy="12" r="3.25" style="fill: currentColor"/><circle cx="12" cy="20.75" r="3.25" style="fill: currentColor"/></g></svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="javascript: void(0);" class="dropdown-item">
                                            Export report
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">
                                            Share
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">
                                            Action
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Date
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    User
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Type
                                                </a>
                                            </th>
                                            
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Credit/Debit
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Currency
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Amount
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort">
                                                    Status
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="list">
                                        @if (allTransactions()->isEmpty())
                                           <tr>
                                           <td colspan="7" align="center">No transaction found</td> 
                                           </tr> 
                                        @else
                                        @foreach (allTransactions() as $log)
                                        <tr>
                                            <td class="currency"><span>{{$log->created_at}}</span></td>
                                            <td class="currency"><span>{{getUser($log->username)->name}}</span></td>
                                            <td class="currency"><span>{{$log->type}}</span></td>
                                            <td><span class="badge @if($log->cred_deb=="Credit")badge-success @else badge-danger @endif">{{$log->cred_deb}}</span></td>
                                            <td>{{$log->currency}}</td>
                                            <td>{{currencyLogo($log->currency)}}{{$log->amount}}</td>
                                            <td class="date"><span class="badge @if($log->status==1)text-bg-success @elseif($log->status==2)text-bg-info @else text-bg-danger @endif">
                                            {{status($log->status)}}</span></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- / .table-responsive -->
                            
                        </div>
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container-fluid -->
@endsection