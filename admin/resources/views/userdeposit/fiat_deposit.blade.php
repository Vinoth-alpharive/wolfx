@php
$atitle ="deposit";
@endphp
@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1> {{ $coin }} Deposit History</h1>
	</header>
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">

				   <form action="{{ url('/admin/deposit/search') }}" method="get" autocomplete="off">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-7 d-flex">
            <input type="hidden" name="coin" class="form-control" value="{{ $coin }}" />
        </div>
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">Select Status</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Complete</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Rejected</option>

            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" class="btn btn-success user_date" value="Search" />
            <a class="btn btn-warning btn-xs" href="{{ url('admin/deposits/'.$coin) }}">Reset</a>
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
							<th>Txid</th>
							
							<th>Deposited Amount ({{ $coin }})</th>
							<th>Credit Amount ({{ $coin }})</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    @if(count($deposit) > 0)
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
						@foreach($deposit as $transactions)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('Y-m-d h:i:s', strtotime($transactions->created_at)) }}</td>
							<td>{{ username($transactions->uid) }}</td>
							<td>{{ $transactions->txid ? $transactions->txid : '-' }}</td>
							<td>{{ display_format($transactions->amount, 8) }}</td>
							<td>{{ display_format($transactions->credit_amount, 8) }}</td>
							<td>
							    @if($transactions->status == 0) 
							    	Waiting for admin confirmation
                                @elseif($transactions->status == 2) 	
                                	Rejected by admin
                                @elseif($transactions->status == 3) 
                                	Cancelled by user
                                @else 
                                	Approved by admin 
                                @endif
							</td>
							<td>
								@if($transactions->status == 0) 
									<a class="btn btn-success btn-xs" href="{{ url('/admin/fiatdeposit_edit/'.Crypt::encrypt($transactions->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
                                @else 
                                	--
                                @endif 

							</td>
						</tr>
						@php
						    $i++;
						@endphp
					@endforeach
					@else
					<tr><td colspan="7"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				@if(count($deposit) > 0)
				    {{ $deposit->links() }}
				@endif
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
@endsection