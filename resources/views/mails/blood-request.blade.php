@component('mail::message')

<table>
    <tr>
        <td>
            <img src="http://127.0.0.1:8000/frontend/img/backend-logo.png" alt="Logo" style="height: 55px; width: 70px; margin-right: 10px;" />
        </td>
        <td>
            <span style="margin-left: 337px;">
                <b> {{ now()->format('M d, Y') }} </b>
            </span>
        </td>
    </tr>
</table>

<br>
# Hello, {{ $name }} <br>

There is urgent need of {{$patent_blood_group}} blood of {{$unit_required}} unit at {{$hospital_name}} {{$hospital_address}}. <br>
Attendent Name : {{$attendent_name}} <br>
Attendent Contact Number : {{$attendent_mobile}} <br>



Thanks,<br>
From HUMANITY BL🩸🩸D DONORS TRUST, KHAGARIA, BIHAR <br>
{{ config('app.name') }}
@endcomponent