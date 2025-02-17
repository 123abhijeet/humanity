@component('mail::message')
<h1>Hello {{ $studentName }}</h1> <br>
<p>Thank you for purchasing the course "{{$course_name}}". Please find your payment receipt attached.</p> <br>
<p>If you have any questions, feel free to contact us.</p> <br>
<p>Best Regards,</p><br>
{{ config('app.name') }}
@endcomponent