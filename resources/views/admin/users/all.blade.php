@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Title -->
    <h1 class="h2">
        All Users
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
                                        Email
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort">
                                        Phone
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort">
                                        Status
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort">
                                        Details
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @if (count($users)==0)
                               <tr>
                               <td colspan="7" align="center">No Users Yet</td> 
                               </tr> 
                            @else
                            @foreach ($users as $user)
                            <tr>
                                <td class="currency"><span>{{$user->name}}</span></td>
                                <td class="date"><span class=""></span>{{$user->email}}</td>
                                <td class="date"><span class=""></span>{{$user->phone_number}}</td>
                                <td class="date"><span class="badge @if($user->is_active)badge-success @else badge-danger @endif">{{userStatus($user->is_active)}}</span></td>
                                <td><a href="{{route('admin.allusers')}}/view/{{$user->id}}" target="_blank"> <button class="btn btn-primary">View Details</button></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div> <!-- / .table-responsive -->
                </div>
                    </div> <!-- / .row -->
                        {{$users->links()}}
                </div>
            </div>
        </div>
@endsection