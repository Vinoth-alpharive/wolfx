@php
$atitle ="deposit";
@endphp
@extends('layouts.header')
@section('title', 'List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1> Deposit History</h1>
	</header>
	<div class="card">
		<div class="card-body">


			  @if ($message = Session::get('updated_status'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
            </div>
            @endif
              
			  <div class="row d-flex">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuDay" data-bs-toggle="dropdown" aria-expanded="false">
                                Download
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuDay">
                                <li><a class="dropdown-item" href="{{ route('depositexport',['key'=>'day']) }}">Day</a></li>
                                <li><a class="dropdown-item" href="{{ route('depositexport',['key'=>'week']) }}">Week</a></li>
                                <li><a class="dropdown-item" href="{{ route('depositexport',['key' =>'month']) }}">Month</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
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
							<th>Asset</th>
							<th>TXN ID</th>
							<th>Recipient</th>
							<th>Amount</th>
							<th colspan="2">Action</th>
						
						</tr>
					</thead>
					<tbody>					
					@if($data->count())
					@php 
			            $i =1;

			            $limit=20;

			            if(isset($_GET['page'])){
							$page = $_GET['page'];
							$i = (($limit * $page) - $limit)+1;
						}else{
						  $i =1;
						}        
					@endphp 
					@foreach($data as $key => $histroy)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('d-m-Y H:i:s', strtotime($histroy->created_at)) }}</td>
							<td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($histroy->uid)) }} ">{{ $histroy->user['first_name'] }} {{ $histroy->user['last_name'] }}</a></td>
							<td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($histroy->uid)) }} ">{{ $histroy->user['email'] }}</a></td>
							<td>{{ $histroy->currency }}</td>
							<td>{{ $histroy->txid }}</td>
							<td>{{ $histroy->to_addr }}</td>
							<td>{{ display_format($histroy->amount,8) }}</td>
							@if(in_array("write", explode(',',$AdminProfiledetails->deposithistory))) 
							<td>
							@if($histroy->status==0)
							<a class="btn btn-success btn-xs" href="{{ url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
							@elseif($histroy->status==2)
								<a class="btn btn-success btn-xs" href="{{ url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
							@elseif($histroy->status==3)
								Cancelled
								@else
								-
							@endif 
							</td>
							@endif
						</tr> 
						@php
						    $i++;
						@endphp
					@endforeach
				@else 
					<td colspan="15">	{{ 'No record found! ' }}</td>
				@endif
					</tbody>
				</table>
				
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($data->count())
				 
				@endif
                </div>
              </div>
				
			</div>
		</div>
	</div>
</section>
@endsection


