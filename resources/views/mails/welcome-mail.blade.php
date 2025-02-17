@component('mail::message')

@php
$company_details = App\Models\DigitalMarketingAutomationDetail::where('user_id','=','1')->first();
@endphp


<table>
    <tr>
        <td>
        @if(!empty($company_details->company_logo))
            <img src="https://larabiztech.in/Company_Logo/{{ $company_details->company_logo }}" alt="Company Logo" style="height: 55px; width: 70px; margin-right: 10px;" />
        @endif
        </td>
        <td>
            <span style="margin-left: 337px;">
                <b> {{ now()->format('M d, Y') }} </b>
            </span>
        </td>
    </tr>
</table>

<br>
# Hello, <br>
{{ $name }} <br>
Welcome back to Lara Biz Tech.

Thanks,<br>
{{ config('app.name') }}
@endcomponent