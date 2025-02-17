@component('mail::message')
# Welcome to Sattree Gurukul <br>
{{$name}} <br>
Your Email Registered Successfully with our records.

Thank You for choosing us!

Below are your login credentials!

Email : {{ $email }}
<br>
Password : {{ $password }} <br>

To log in, click the following link:
<a href="">Login</a> <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent