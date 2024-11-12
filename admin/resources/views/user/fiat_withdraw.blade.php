@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Currency Withdraw History</h1>
	</header>
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
					<br /><br />
					<div class="tab-container">

						<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/users_edit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">User Details</a>
						</li>
							<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC') }}" role="tab">Transactions</a>
						</li>

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
						<a class="nav-link " href="{{ url('/admin/userfiatdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Currency Deposit</a>
						</li>
						<li class="nav-item">
						<a class="nav-link active" href="{{ url('/admin/user_fiat_withdraw/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Currency Withdraw</a>
						</li>
				
						
						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/user_buy_tradehistory/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Trade</a>
						</li>


						<li class="nav-item">
						<a class="nav-link active"
						href="{{ url('/admin/user_commissions/' . Crypt::encrypt($userdetails->id)) }}"
						role="tab">Commission Settings</a>
						</li>
                                
						</ul>

						</br>
					</div>

		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.NO</th>
							<th>Date & Time</th>
							<th>Currency</th>
							<th>Requested Withdraw Amount</th>
							<th>Withdraw Fee</th>
							<th>Total Deducted Amount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    @if(count($transaction) > 0)
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
					@foreach($transaction as $transactions)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('Y/m/d h:i:s', strtotime($transactions->created_at)) }}</td>
							<td>{{ $transactions->type }}</td>
							<td>{{ number_format($transactions->request_amount, 2, '.', '') }}</td>
							<td>{{ number_format($transactions->fee, 2, '.', '') }}</td>
							<td>{{ number_format($transactions->amount, 2, '.', '') }}</td>
							<td>
							    @if($transactions->status == 0) Waiting for admin confirmation
                                @elseif($transactions->status == 2) Rejected by admin
                                @elseif($transactions->status == 3) Cancelled by user
                                @else Approved by admin @endif
							</td>
							<td><a class="btn btn-success btn-xs" href="{{ url('/admin/withdraw_edit/'.Crypt::encrypt($transactions->id)) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>
						</tr>
						@php
						    $i++;
						@endphp
					@endforeach
					@else
					    <tr><td colspan="15"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($transaction->count())
				    {{ $transaction->links() }}
				@endif
                </div>
              </div>
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
@endsection