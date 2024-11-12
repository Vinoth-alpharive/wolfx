@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', ' Trade History')
@section('content')
<style>
	.status-pending {
		color: orange;
		font-weight: bold;
	}

	.status-cancelled {
		color: red;
		font-weight: bold;
	}

	.status-completed {
		color: green;
		font-weight: bold;
	}
</style>
<section class="content">
	<header class="content__title">
		<h1>Buy Trade History</h1>
	</header>
	<div class="card">
		<div class="card-body">
			<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
			<br /><br />
			<div class="tab-container">

				<ul class="nav nav-tabs" role="tablist" style="text-align: center;">
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/users_edit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">User Details</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC') }}" role="tab">Transactions</a>
					</li>

					<!-- <li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/users_referral/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Referral</a>
						</li> -->

					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/userkyc/'.Crypt::encrypt($userdetails->id)) }}" role="tab">KYC</a>
					</li>


					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Wallet</a>
					</li>


					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Deposit</a>
					</li>


					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/user_withdraw/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Withdraw</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/userfiatdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Currency Deposit</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/user_fiat_withdraw/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Currency Withdraw</a>
					</li>


					<li class="nav-item">
						<a class="nav-link active" href="{{ url('/admin/user_buy_tradehistory/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Trade</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/user_commissions/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Commission Settings</a>
					</li>


				</ul>

				</br>
			</div>

			<div class="tab-content">
				<div id="buyo" class="tab-pane fade in active show">
					<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
						<table class="table" id="dows">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Date / Time</th>
									<th>Type</th>
									<th>Pair</th>
									<th>Price</th>
									<th>Amount</th>
									<th>Remaining</th>
									<th>Cancelled</th>
									<th>Total</th>
									<th>Trade Fee</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@php
								$i =1;

								$limit=15;

								if(isset($_GET['page'])){
								$page = $_GET['page'];
								$i = (($limit * $page) - $limit)+1;
								}else{
								$i =1;
								}
								@endphp
								@forelse($buytrade as $trade)
								@php $cancelled = 0.0000; $remaining = $trade->remaining; @endphp
								@if($trade->status == 2)
								@php $cancelled = $trade->remaining; $remaining = 0.0000 @endphp
								@endif
								<tr>
									<td>{{ $i }}</td>
									<td>{{ date('d/m/Y H:i:s', strtotime($trade->created_at)) }}</td>
									<td>{{ $trade->trade_type }}</td>
									<td>{{ $trade->pair_get->coinone.'/'.$trade->pair_get->cointwo }}</td>
									<td>{{ number_format($trade->price, 8, '.', '') }}</td>
									<td>{{ number_format($trade->volume, 8, '.', '') }}</td>
									<td>{{ number_format($remaining, 8, '.', '') }}</td>
									<td>{{ number_format($cancelled, 8, '.', '') }}</td>
									<td>{{ number_format($trade->value, 8, '.', '') }}</td>
									<td>{{ number_format($trade->fees, 8, '.', '') }}</td>
									<td>
										@if($trade->status == 0)
										<span class="status-pending">Pending</span>
										@elseif($trade->status == 100)
										<span class="status-cancelled">Cancelled</span>
										@else
										<span class="status-completed">Completed</span>
										@endif
									</td>
								</tr>
								@php
								$i++;
								@endphp
								@empty
								<tr>
									<td colspan="10">
										<div class="alert alert-info">Yet no trades available</div>
									</td>
								</tr>
								@endforelse

							</tbody>
						</table>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
						<div class="pagination-tt clearfix">
							@if($buytrade->count())
							{{ $buytrade->links() }}
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endsection
	<script>
		function pageredirect(self) {
			window.location.href = self.value;
		}
	</script>