@extends('layouts.header')
@section('title', 'Commission History')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Admin Commission History</h1>
    </header>
        <div class="card">
          <div class="card-body">

          <div class="row">
        <div class="col-md-6 tg-select-left">
           <h4 class="card-title">Admin Commission History - Total Amount : {{display_format($comm_sum)}} {{$pairdetails}}</h4>
        </div>
        <div class="col-md-6 tg-select">
          
          <select onchange="location = this.value;" class="form-control custom-s">
                    @if(isset($pairs))
                        <option value="{{ url('admin/commissionhistory/'.$pairdetails) }}">{{ $pairdetails }}</option>
                        @foreach($pairs as $coinones) 
                          @if($coinones->source != $pairdetails)
                            <option value="{{ url('admin/commissionhistory/'.$coinones->source) }}">{{ $coinones->source }}</option>
                          @endif
                        @endforeach
                    @endif
                  </select>
        </div>
      </div>


         
            <div class="table-responsive">
           
              <table class="table">
                <thead>
                <tr>
                <th>S.No</th>
                <th>Coin</th>
                <th>FullName</th>
                <th>Email</th>
                <th>Type</th>
                <th>Commission Amount({{$pairdetails}})</th>
<th>Date Time</th>
                </tr>
                </thead>
                <tbody> 
                @forelse($commissions as $key => $commission)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->currency }}</td>
                    <td>{{ $commission->userDetails['name'] }} {{ $commission->userDetails['lastname'] }}</td>
                    <td>{{ $commission->userDetails['email'] }}</td>
                    <td>@if($commission->trade_type==1) Buy 
                        @elseif($commission->trade_type==2) Sell 
                        @else {{$commission->trade_type}}
                        @endif 
                    </td>
                    <td>{{ $commission->commission_amount }}</td>
			<td>{{ date('d-m-Y H:i:s',strtotime($commission->created_at)) }}</td>

                        
                  </tr>
                  @empty
<tr><td colspan="5"> No Record Found </td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $commissions->links() }}
              
            </div>
          </div>
        </div>
  </section>
@endsection