@include('email.header')
<tr><td colspan='3' align='center' height='20' style='padding:0px;'></td></tr>
<tr>
	<td align='left'>&nbsp;</td>
	<td style='text-align:left;font-size: 15px;color:#000;'>Dear {{ $user->first_name.' '.$user->last_name }},</td>
	<td align='left'>&nbsp;</td>
</tr>
<tr>
	<td align='left'>&nbsp;</td>
	<td style='text-align:left;font-size: 15px;color:#000;'>We have reviewed your KYC request and unfortunately had to reject it for the following reason: {{ $kyc->remark }}. Please log in and fill out the KYC form again.</td>
	<td align='left'>&nbsp;</td>
</tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
@include('email.footer')
