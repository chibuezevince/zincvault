@extends('admin.layouts.app')

@section('content')
<main>
    <style>
.avatars {
  vertical-align: middle; !important
  width: 300px; !important
  height: 300px;!important
  border-radius: 30%;!important
  text-align: center;!important
}
.center {
  margin: auto;!important
}

    </style>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">User Detail</h3>
                <div class="col-md-12 col-12 ">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-1" width="200px" src="{{$user_details->profile_image}}">
                    </div>
                </div>
                <table class="table table-bordered mb-0">
                    <thead class="thead-dark">
                      <tr>
                        <th>Item</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>Name</td>
                            <td>{{$user->name}} </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$user->email}} </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{$user->username}} </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{$user_details->gender}}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>{{$user->phone_number}} </td>
                        </tr>
                        <tr>
                            <td>Account Number</td>
                            <td>{{$user->account_number}} </td>
                        </tr>
                        <tr>
                            <td>Account Type</td>
                            <td>{{$user_details->account_type}}</td>
                        </tr>
                        <tr>
                            <td>Dollar Balance</td>
                            <td>${{$user_details->dollar_balance}}</td>
                        </tr>
                        <tr>
                            <td>Euro Balance</td>
                            <td>€{{$user_details->euro_balance}}</td>
                        </tr>
                        <tr>
                            <td>Pound Balance</td>
                            <td>£{{$user_details->pound_balance}}</td>
                        </tr>
                        <tr>
                            <td>IMF code</td>
                            <td>{{$user_details->imf}}</td>
                        </tr>
                        <tr>
                            <td>TAC Code</td>
                            <td>{{$user_details->tac}}</td>
                        </tr>
                        <tr>
                            <td>TAX</td>
                            <td>{{$user_details->tax}}</td>
                        </tr>
                        <tr>
                            <td>Account Creation Date</td>
                            <td>{{$user_details->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> <span class="badge @if($user->is_active)badge-success @else badge-danger @endif">{{userStatus($user->is_active)}} </span></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><a href="{{route('admin.allusers')}}/edit/{{$user->id}}"> <button class="btn btn-primary">Edit User Details</button></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection