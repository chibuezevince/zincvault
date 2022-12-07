@extends('admin.layouts.app')
@section('content')
<div class="container">
<form action="{{route('admin.send_transaction')}}" method="POST" id="adminLocalTransfer">
                
    @csrf
    <!-- Card -->
    <div class="card border-0 scroll-mt-3" id="creditDebitSection">
        <div class="card-header">
            <h2 class="h3 mb-0"> Credit/Debit User</h2>
        </div>
        <div id="error" class="alert alert-danger" style="display: none"></div>
        <div id="success" class="alert alert-success" style="display: none"></div>
        <div class="card-body">
            <div class="col-lg-12 mb-4">
                <label for="receiver_account_number" class="form-label">Account Number</label>
                <input type="text" class="form-control" id="receiver_account_number" name="receiver_account_number">
            </div>
            <div class="mb-3" style="display: none" id="receiver_info_box">
                <label class="form-label" for="receiver_info">Receiver Account Name</label>
                <input type="text" readonly class="form-control " id="receiver_info" value="" placeholder="Account Number of User">
              </div>
            <div class="row mb-4">
                <div class="col-lg mt-4">
                    <label for="cred_deb" class="form-label">Credit/Debit</label>
                    <select name="cred_deb" id="cred_deb" class="form-select">
                        <option value="">Select One</option>
                        <option value="Credit">Credit</option>
                        <option value="Debit">Debit</option>
                    </select>
                </div>
                <div class="col-lg mt-4">
                    <label for="currency" class="form-label">Currency Type</label>
                    <select name="currency" id="currency" class="form-select">
                        <option value="">Select One</option>
                        <option value="dollar">USD</option>
                        <option value="euro">EUR</option>
                        <option value="pound">GBP</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount">
                </div>
                <div class="col-lg-12 mt-4">
                    <label for="note" class="form-label">Note</label>
                    <textarea name="note" id="note" cols="2" rows="3" class="form-control"></textarea>
                </div>
            </div> <!-- / .row -->
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="send_email" name="send_email" value="1"> 
                <label class="form-label" for="flexCheckDefault">
                    Send User Email Notification
                </label>
              </div>
            <div class="d-flex justify-content-end mt-5">

                <!-- Button -->
                <button id="loading" class="btn btn-primary" type="button" disabled style="display: none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </button>
                <button id="done" type="submit" class="btn btn-primary">Update</button>    
            </div> 
        </div>
    </div>
    </form>
</div>    
    @endsection