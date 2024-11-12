@extends('layouts.header')
@section('title', 'Affiliate History')
@section('content')
<section class="content">
	
	<header class="content__title">
		<h1>Affiliate History</h1>
	</header>
	<div class="card">
		<div class="card-body">
		
			<div class="tab-content">
				<div id="buyo" class="tab-pane fade in active show">
					<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
					

						<table class="table" id="dows">
							<thead>
								<tr>
									<th>S.no</th>
									<th>Date / Time</th>
									<th>User Name</th>
									<th>Type</th>
									<th>Coin Name</th>
									<th>Commission</th>
									<th>Reason</th>
									<!-- <th>Price</th>
									<th>Quantity</th> -->
									
								</tr>
							</thead>
							<tbody>
								@if($Affliate->count())
								@php
								$limit = 15; 
									if(isset($_GET['page'])){
									$page = $_GET['page'];
									$i = (($limit * $page) - $limit)+1;
									}else{
									$i =1;
									}

								@endphp								
								@foreach($Affliate as $val)								   
								<tr>
									<td>{{ $i }}</td>
									<td>{{ date('d/m/Y H:i:s', strtotime($val->created_at)) }}</td>
									<td>{{ $val->user->first_name }} {{ $val->user->last_name }}</td>
									<td>{{ ucfirst($val->type) }}</td>
									<td>{{ $val->coin }}</td>
									<td>{{ $val->commission }}</td>
									<td>{{ $val->reason }}</td>
									<!-- <td>{{ $val->price ? $val->price : '-' }}</td>
									<td>{{ $val->quantity }}</td> -->
									
								</tr>
								@php $i ++ ;@endphp	
								@endforeach
								@else 
								<tr>
								<td colspan="10">
								<div class="alert alert-info">Yet no histroy available</div>
								</td>
								</tr>
								@endif
							</tbody>
						</table>
						
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($Affliate->count())
				    {{ $Affliate->links() }}
				@endif
                </div>
              </div>
				</div>
			</div>
		</div>
	</div>

@endsection
<script>
    function pageredirect(self){
	window.location.href = self.value;
}
</script>