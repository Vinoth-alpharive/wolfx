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
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">

 <form action="{{ url('/admin/withdrawal/search') }}" method="get" autocomplete="off">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">                
            {{-- <input type="text" name="searchitem" class="form-control" placeholder="Search for User Name or Email" value="{{ request('searchitem') }}" required=""/> --}}
            <input type="hidden" name="coin" class="form-control" value="{{ $currency }}" />
        </div>
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">Select Status</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Completed</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Rejected</option>

            </select>
        </div>
        <div class="col-md-3">
            <input type="submit" class="btn btn-success user_date" value="Search" />
            <a class="btn btn-warning btn-xs" href="{{ url('admin/withdraw/'.$currency) }}">Reset</a>
        </div>
    </div>
</form>





		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Date & Time</th>
							<th>User Name</th>
							<th>Requested Withdraw Amount ({{ $currency }})</th>
							<th>Withdraw Fee ({{ $currency }})</th>
							<th>Total receiving amount ({{ $currency }})</th>
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
							<td>{{ username($transactions->uid) }}</td>
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
					    <tr><td colspan="9"> No record found!</td></tr>
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