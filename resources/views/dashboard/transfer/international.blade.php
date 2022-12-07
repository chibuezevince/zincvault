@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">

        <!-- Title -->
        <h1 class="h2">
            International Transfer
        </h1>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Transfer</li>
                <li class="breadcrumb-item active" aria-current="page">International Transfer</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
    <form action="{{route('transfer.international')}}" method="POST" id="internationalTransferForm">
        <div id="transferError" class="alert alert-danger" style="display: none"></div>
        <div id="transferSuccess" class="alert alert-success" style="display: none"></div>
          @csrf
              <div class="row mb-5">
                <div class="col-md-6 mb-5">
                    <div class="form-group">
                        <label class="form-label">Beneficiary Name</label>
                        <input  type="text" class="form-control" name="beneficiary_name" id="beneficiary_name">
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="form-group">
                        <label class="form-label">Beneficiary Account Number</label>
                        <input  type="number" class="form-control" name="beneficiary_acc_num" id="beneficiary_acc_num">
                    </div>
                </div> 
                <div class="col-md-6 mb-5">
                    <div class="form-group">
                        <label class="form-label">Beneficiary Bank</label>
                        <input  type="text" class="form-control" name="beneficiary_bank" id="beneficiary_bank">
                    </div>
                </div> 
                <div class="col-md-6 mb-5">
                    <div class="form-group">
                        <label class="form-label">Beneficiary Swift Code</label>
                        <input  type="text" class="form-control" name="beneficiary_swiftcode" id="beneficiary_swiftcode">
                    </div>
                </div>  
                <div class="col-md-6 mb-5">
                    <div class="form-group">
                        <label class="form-label">Routing Transit Number(RTN)</label>
                        <input  type="text" class="form-control" name="routing_transit_no" id="routing_transit_no">
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Currency</label>
                        <select class="form-select" name="currency" id="currency" >
                            <option value="">Select One</option>
                            <option value='dollar'>USD</option><option value='euro'>EUR</option><option value='pound'>GBP</option>
                        </select>
                    </div>
                </div>  
                <div class="col-md-12 mb-5">
                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="number"  class="form-control" name="amount" id="amount">
                        <div class="text-info">
                            <strong><small style="font-size: 10px" class="mx-auto ml-5"> Transfer charge of {{settings('international_transfer_charge')}}% applies</small></strong>
                        </div> 
                    </div>
                </div> 
              </div>
              <div class="text-center" id="exchangeLoader" style="display: none">
              <span class="spinner-grow text-primary" role="status" align="center"></span> 
              </div>
            <div class="row mb-5">
                <label class="form-label">Purpose of Transfer</label>
                <div class="col">
                <textarea name="note" id="note" class="form-control" cols="50" rows="7" ></textarea>
            </div>
            </div>
        <div class="text-center">
            <button id="transferLoading" class="btn btn-primary mt-4 btn-block" type="button" disabled style="display: none">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="sr-only">Processing Exchange...</span>
            </button> 
            <button class="btn btn-primary btn-block mt-4" type="submit" id="transferDone">Send Transaction</button>
        </div>
            </form>
        </div> 
    </div> 
</div> <!-- / .container-fluid -->

@endsection