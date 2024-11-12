@php
$atitle ="selltrade";
@endphp
@extends('layouts.header')
@section('title', ' Trade History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Sell Trade History</h1>
	</header>
	<div class="card">
		<div class="card-body">
			<form action="{{url('admin/sell_tradehistory')}}" method="GET">
				@csrf
			<div class="row">
				<div class="col-md-5 tg-select-left">
					<select class="form-control custom-s-left" name="tradetype">
						<option value="">Select Trade Type</option>
                        <option value="limit" @if($order_type!="" && $order_type==1) selected @endif>Limit</option>
                        <option value="market" @if($order_type!="" && $order_type==2) selected @endif>Market</option>
                    </select>
				</div>
				<div class="col-md-5 tg-select">
					
					<select class="form-control custom-s" name="tradepairname">
                    @if(isset($pairs))
                        {{-- <option value="{{ url('admin/sell_tradehistory/'.$tradepair->coinone.'_'.$tradepair->cointwo.'/'.$type) }}">{{ $tradepair->coinone }} / {{ $tradepair->cointwo }}</option> --}}
						<option value="">Select Trade Pair</option>
                        @foreach($pairs as $coinones) 
							<option value="{{$coinones->coinone.'_'.$coinones->cointwo}}" @if($coinones->coinone.'_'.$coinones->cointwo == @$tradepair->coinone.'_'.@$tradepair->cointwo) selected @endif>{{ $coinones->coinone }} / {{ $coinones->cointwo }}</option>
							@endforeach
                    @endif
                  </select>
				</div>
				<div class="col-md-2">
					<input type="submit" name="submit" value="Filter" class="btn btn-warning btn-xs"/>
				</div>
			</div>
			</form>
			<div class="tab-content">
				<div id="buyo" class="tab-pane fade in active show">
					<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
						<table class="table" id="dows">
							<thead>
								@if($tradepair != "")
								<tr>
									<th>S.NO</th>
									<th>Date / Time</th>
									<th>User Name</th>
									<th>Price ({{ $tradepair->cointwo }})</th>
									<th>Amount ({{ $tradepair->coinone }}) </th>
									<th>Remaining ({{ $tradepair->coinone }}) </th>
									<th>Cancelled ({{ $tradepair->coinone }}) </th>
									<th>Total ({{ $tradepair->cointwo }}) </th>
									<th>Trade Fee ({{ $tradepair->cointwo }}) </th>
									<th>Status</th>
								</tr>
								@else
								<tr>
									<th>S.NO</th>
									<th>Date / Time</th>
									<th>User Name</th>
									<th>Price </th>
									<th>Amount</th>
									<th>Remaining</th>
									<th>Cancelled</th>
									<th>Total</th>
									<th>Trade Fee</th>
									<th>Status</th>
								</tr>
								@endif
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
								<tr>
									<td>{{ $i }}</td>
									<td>{{ date('d/m/Y H:i:s', strtotime($trade->created_at)) }}</td>
									<td>{{ $trade->user->name }}</td>
									<td>{{ number_format($trade->price, 8, '.', '') }}</td>
									<td>{{ number_format($trade->volume, 8, '.', '') }}</td>
									<td>{{ number_format($remaining, 8, '.', '') }}</td>
									<td>{{ number_format($cancelled, 8, '.', '') }}</td>
									<td>{{ number_format($trade->value, 8, '.', '') }}</td>
									<td>{{ number_format($trade->fees, 8, '.', '') }}</td>
									<td>@if($trade->status == 0 ) Pending @elseif($trade->status == 100 ) Cancelled @else Completed  @endif</td>
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
	</div>

@endsection
<script>
    function pageredirect(self){
	window.location.href = self.value;
}
</script>