@include('email.header')
<tr><td colspan='3' align='center' height='20' style='padding:0px;'></td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Dear {{ $seller->first_name." ".$seller->last_name }},</td><td align='left	'>&nbsp;</td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Admin Complete Your Trade! For Price {{$selltrade->price}} INR and Volume {{$selltrade->volume}} USDT</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
{{-- <tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Remarks</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'>{{$selltrade->remarks}}</td></tr> --}}
<td colspan='2' align='center' height='1' style='padding:0px;'>{{$selltrade->order_id}}</td></tr>
@include('email.footer')