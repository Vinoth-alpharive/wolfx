@php
$atitle ="sell";
@endphp
@extends('layouts.header')
@section('title', 'P2PMarketplace')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Pending Sell Trades</h1>
	</header>
	<div class="card">
		<div class="card-body">
		<div class="table-responsive search_result">	
						<table class="table" id="dows">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Date / Time</th>
									<th>User Name</th>
                                    <th>Type</th>
									<th>Price </th>
									<th>Amount  </th>
									<th>Remaining  </th>
									<th>Cancelled  </th>
									<th>Total  </th>
									<th>Trade Fee  </th>
									<th>Status</th>
									<th>Action</th>
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
								@forelse($selltrade as $trade)
								    @php $cancelled = 0.0000; $remaining = $trade->remaining; @endphp
                                    @if($trade->status == 2)
                                        @php $cancelled = $trade->remaining; $remaining = 0.0000 @endphp
                                    @endif

                          
                                    @if($trade->order_type == 1)
                                       @php 
                                       $price = number_format($trade->price, 8, '.', ''); 
                                       @endphp
                                    @else
                                      @php $price = "-";  @endphp
                                    @endif
                                    @php $user = username($trade->uid); @endphp 
								<tr>
									<td>{{ $i }}</td>
									<td>{{ date('d/m/Y H:i:s', strtotime($trade->created_at)) }}</td>
									<td>{{ $user }}</td>
									<td>{{ $trade->trade_type}}</td>

									<td>{{ $price }}</td>
									<td>{{ number_format($trade->volume, 8, '.', '') }}</td>
									<td>{{ number_format($remaining, 8, '.', '') }}</td>
									<td>{{ number_format($cancelled, 8, '.', '') }}</td>
									<td>{{ number_format($trade->value, 8, '.', '') }}</td>
									<td>{{ number_format($trade->fees, 8, '.', '') }}</td>
									<td>{{$trade->status_text}}</td>
									<td><a href="{{ url('/admin/sellhistoryview', Crypt::encrypt($trade->id)) }}" class="btn btn-sm btn-info">View</a></td>
								</tr>
								@php
						         $i++;
						         @endphp
								@empty
								<tr><td colspan="10"><div class="alert alert-info">Yet no trades available</div></td></tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($selltrade->count())
				    {{ $selltrade->links() }}
				@endif
                </div>
              </div>
				</div>
		</div>
	</div>
</section>
@endsection
<script>
    function pageredirect(self){
	window.location.href = self.value;
}
</script>