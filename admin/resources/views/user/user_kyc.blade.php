@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', 'Users Kyc - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>User Kyc</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
					<br /><br />
					@if(session('updated_status'))
					    <div class="alert alert-success">
                              {{ session('updated_status') }}
                        </div>
					@endif

					<div class="tab-container">

						<ul class="nav nav-tabs" role="tablist">
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
						<a class="nav-link active" href="{{ url('/admin/userkyc/'.Crypt::encrypt($userdetails->id)) }}" role="tab">KYC</a>
						</li>

						<li class="nav-item">
						<a class="nav-link" href="{{ url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Wallet</a>
						</li>


						<li class="nav-item">
						<a class="nav-link " href="{{ url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Deposit</a>
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
							<th>S.No</th>
							<th>Date & Time</th>
							<th>User Name</th>
							<th>DOB</th>
							<th>Phone No</th>
							<th>Country</th>
							<th>Kyc Verify</th>
							<th colspan="2">Action</th>
						</tr>
							</thead>
							<tbody>
							@php 
							$i =1;
							$limit=10;
							if(isset($_GET['page'])){
							$page = $_GET['page'];
							$i = (($limit * $page) - $limit)+1;
							}else{
							$i =1;
							}        
							@endphp 
							@forelse($kyc as $key => $user)
							<tr>
							<td>{{ $i }}</td>
							<td>{{ date('m-d-Y H:i:s', strtotime($user->created_at)) }}</td>
							<td>{{ $user->fname.' '.$user->lname }}</td>
							<td>{{ $user->dob }}</td>
							<td>{{ $user->phone_no }}</td>
							<td>{{ $user->country }}</td>
							<td>@if($user->status == 0) Waiting @elseif($user->status == 1) Accepted @elseif($user->status == 2) Rejected @else No @endif</td>
							<td><a class="btn btn-success btn-xs" href="{{ url('admin/kycview/'.Crypt::encrypt($user->id)) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>
							</tr> 
							@php
							$i++;
							@endphp
							@empty
							<tr><td colspan="7"> No record found!</td></tr>
							@endforelse
							</tbody>
							</table>
						</div>
							<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($kyc->count())
				    {{ $kyc->links() }}
				@endif
                </div>
              </div>


				</div>
			</div>
		</div>
	</div>
@endsection