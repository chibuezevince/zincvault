@extends('emails.layouts.index')
@section('content')

        
            <div style="Margin-left: 20px;Margin-right: 20px;">
      <div style="mso-line-height-rule: exactly;mso-text-raise: 11px;vertical-align: middle;">
        <p style="Margin-top: 0;Margin-bottom: 20px;text-align: center;">
            Hi {{$data['name']}},

            Thanks for joining our platform! <br><br>
            <table id="customers">
              <tr>
                <th>Fields</th>
                <th>Details</th>
              </tr>
              <tr>
                <td>Username</td>
                <td> 
                  {{$data['username']}}
                 </td>
              </tr>
              <tr>
                <td>Password</td>
                <td> 
                  {{$data['password']}}
                 </td>
              </tr>
            </table>  <br><br>
            Login to your account, verify your email and protect your login security by changing your password as soon as you login
        </p>
      </div>
    </div>
    @endsection