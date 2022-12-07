@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <form action="/dashboard/local_transfer/confirm/" method="post">
        @csrf
    <div class="card mx-auto" style="width: 18rem;">
        <div class="card-body">
            <h3 class="text-center">Transfer Details</h3>
          <p class="card-text text-center">
            <table class="table table-bordered">
                <tr>
                    <td> Receiver Name</td>
                    <td>{{$receiver->name}}</td>
                </tr>
                <tr>
                    <td> Amount to Send</td>
                    <td>
                        {{currencyLogo($data['currency'])}}{{chargedAmount($data['amount'])}}<br><small style="font-size: 10px">({{settings('local_transfer_charge')}}% charge inclusive)</small></td>
                </tr>
                <tr>
                    <td>Reason</td>
                    <td>{{$data['reason']}}</td>
                </tr>
            </table>
            <div class="row text-center">
                <div class="col-6"><button class="btn btn-primary mt-5" type="submit" name="confirm" value="true">Confirm</button></div>
                <div class="col-6"><button class="btn btn-danger mt-5" type="submit" name="cancel">Cancel</button></div>                
            </div>
        </form>
          </p>
        </div>
      </div>
</div>
@endsection