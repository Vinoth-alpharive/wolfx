@php
$atitle ="withdraw";
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>{{ $currency }} Withdraw History</h1>
	</header>
	@if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong>
        </div>
    @endif
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
			  @if ($message = Session::get('updated_status'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
            </div>
            @endif            
		    <form action="{{ url('/admin/withdrawal/search') }}" method="get" autocomplete="off">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-4">                
						<input type="text" name="searchitem" class="form-control" placeholder="Search for User Name or Email" value= "{{ $q ? $q : '' }}" required=""/>
						<input type="hidden" name="coin" class="form-control"  value= "{{ $currency }}" />
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-success user_date" value="Search" />
						<a class="btn btn-warning btn-xs" href="{{ url('admin/withdraw/'.$currency) }}"> Reset </a> 
					</div>
					</form>
					{{-- <div class="col-md-3">
						<a class="btn btn-warning" href="{{ route('withdrawalexport',['coin' => $currency ]) }}">Export To Excel</a>
					</div> --}}
				</div>
			
			<br/>
			<div class="card-body">
		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Date & Time</th>
							<th>Username</th>
							<th>Email</th>
							<th>Txn ID</th>
							<!-- <th>Withdraw type</th> --> 
							<th>Sender</th>
							<th>Recipient</th>
							<th>Amount</th> 
							<th>Admin Fee</th> 
							<th>Status</th> 
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
							<td>{{ date('Y/m/d h:i:s', strtotime($transactions->created_at ?? '')) }}</td>
							<td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($transactions->uid ?? '')) }} ">{{ $transactions->user['username'] ?? ''}}</a></td>
							<td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($transactions->uid)) ?? ''}} ">{{ $transactions->user['email'] ?? ''}}</a></td>
							<td>{{ $transactions->transaction_id ?? ''}}</td>
							<!-- <td>{{ $transactions->withdrawtype ? $transactions->withdrawtype : '-'	 }}</td> -->
							<td>{{ $transactions->sender ?? ''}}</td>
							<td>{{ $transactions->reciever ?? ''}}</td>
							<td>{{ number_format($transactions->amount ?? '', 8, '.', '') }}</td>
							<td>{{ number_format($transactions->admin_fee ?? '', 8, '.', '') }}</td>
							<td> 
							     <a class="btn btn-success btn-xs" href="{{ url('/admin/crypto_withdraw_edit/'.\Crypt::encrypt($transactions->id ?? '')) }}"><i class="zmdi zmdi-edit"></i> View </a> 
							</td> 
						</tr>
						@php
						    $i++;
						@endphp
					@endforeach
					@else
					    <tr><td colspan="10"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($transaction->count())
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