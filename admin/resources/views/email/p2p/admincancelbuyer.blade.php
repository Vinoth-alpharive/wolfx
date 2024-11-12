@include('email.header')
<tr><td colspan='3' align='center' height='20' style='padding:0px;'></td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Dear {{ $buyer->first_name." ".$buyer->last_name }},</td><td align='left	'>&nbsp;</td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Admin Cancelled Your Match! For Price {{$buytrade->price}} INR and Volume {{$buytrade->volume}} USDT</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
<td colspan='2' align='center' height='1' style='padding:0px;'>{{$buytrade->order_id}}</td></tr>
@include('email.footer')