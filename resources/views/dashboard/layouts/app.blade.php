@if (user()->type==2)
@include('dashboard.layouts.header')
@include('dashboard.layouts.navbar')
 
        @yield('content')
@include('dashboard.layouts.footer')
@else
@include('admin.layouts.header')
@include('admin.layouts.navbar')
 
        @yield('content')
@include('admin.layouts.footer')
@endif