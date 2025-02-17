@component('mail::message')
<h1>Hello {{ $name }}</h1> <br>
<p>{{$message}}.</p> <br>
<p>Please find your attachment below.</p> <br>
<p>If you have any questions, feel free to contact us.</p> <br>
<p>Best Regards,</p><br>
{{ config('app.name') }}
@endcomponent