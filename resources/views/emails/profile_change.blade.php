@extends('emails.layouts.index')
@section('content')
  <div style="margin-bottom:40px">
      <h3 style="font-family:sans-serif;font-weight:700;font-size:14px;line-height:20px;color:#000;margin:unset unset 8px">
      Hello {{$user->name}},</h3>
      <div style="margin-top:8px">
          <p style="width:100%;line-height:20px;font-family:sans-serif;font-size:14px;color:#000;display:block;margin:unset">
            Your profile information has been changed. <br>
        Please, contact us if you did not effect this change.
        
       </div>
  </div>
</div>
@endsection            