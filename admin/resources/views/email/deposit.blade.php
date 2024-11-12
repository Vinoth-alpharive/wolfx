@include('email.header')

<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Deposit Completed!</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
@if($details['status'] == 'Accept')
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>A deposit of {{ display_format($details['amount'],8) }} {{ $details['coin'] }}  to Your PEOPLETRADE account has been completed! Happy trading! </td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>
@else
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Your {{ $details['amount'] }} {{ $details['coin'] }} Deposit Request has been cancelled by admin . Kindly login your {{ config('app.name') }} account and check {{ $details['coin'] }} deposit history </td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>
@endif
<tr><td colspan='3' align='center' height='30' style='padding:0px;'></td></tr>

@include('email.footer')