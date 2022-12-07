@extends('admin.layouts.app')

@section('content')
<div class="container">
      <div class="card">
        <div class="card-body">
          <h3 class="text-center">Site Settings</h3>
          <hr>
    <form method="POST" enctype="multipart/form-data" id="settingsForm" action="{{route('admin.update_settings')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="site_name">Site Name</label>
            <input name="site_name" type="text" class="form-control" id="site_name" value="{{settings('site_name')}}" placeholder="sitename.com" >
        </div>
        <div class="mb-3">
            <label class="form-label" for="site_email">Site Email</label>
            <input name="site_email" type="text" class="form-control" id="site_email" placeholder="eg. support@sitename.com"  value="{{settings('site_email')}}">
        </div>
        <div class="mb-3" >
          <label class="form-label" for="site_logo">Site Logo</label>
          <input type="file" name="site_logo" class="form-control" id="site_logo">
        </div>
        
        <br><hr>


        <h3 class="text-center">Site Charges</h3>
        <div class="mb-3">
            <label class="form-label" for="local_transfer_charge">Local Transfer Charges(%)</label>
            <input type="text" value="{{settings('local_transfer_charge')}}" name="local_transfer_charge" class="form-control" id="local_transfer_charge" placeholder="From 0-100%" max="100" required >
        </div>

        <div class="mb-3">
            <label class="form-label" for="international_transfer_charge">International Transfer Charges(%)</label>
            <input type="text" value="{{settings('international_transfer_charge')}}" name="international_transfer_charge" class="form-control" id="international_transfer_charge" placeholder="From 0-100%" max="100" required >
        </div>

        <div class="mb-3">
            <label class="form-label" for="exchange_fee">Exchange Fee(%)</label>
            <input type="text" value="{{settings('exchange_fee')}}" name="exchange_fee" class="form-control" id="exchange_fee" placeholder="From 0-100%" max="100" required >
        </div>

                            <!-- Button -->
                            <button id="loading" class="btn btn-primary" type="button" disabled style="display: none">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Loading...</span>
                            </button>
                            <button id="done" type="submit" class="btn btn-primary">Update</button>    
    </form>
        </div>
      </div>                       
</div> 
@endsection