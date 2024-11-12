@php
$atitle ="commission";
@endphp
@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Commission Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Currency</th>
                    <th>Name</th>
                    <th>Withdraw</th>
                    <th>Commission Type</th>
                    <th>Net Fee</th>
                    <th>Deposit Status</th>
                    <th>Withdraw Status</th>
                     <th>Swap Status</th>
                     @if(in_array("write", explode(',',$AdminProfiledetails->commissionsetting))) 
                    <th>Status</th>
                    @endif
                      
                  </tr>
                </thead>
                <tbody> 
                @forelse($commissions as $key => $commission)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->source }}</td>
                    <td>{{ $commission->coinname }}</td>
                    <td>{{ $commission->withdraw }}</td>
                    <td>{{ $commission->com_type }}</td>
                    <td>{{ number_format($commission->netfee, 8) }}</td>
                    <td>{{ $commission->is_deposit == 1 ? 'Active' : 'Deactive' }}</td>
                    <td>{{ $commission->is_withdraw == 1 ? 'Active' : 'Deactive' }}</td>
                     <td>{{ $commission->is_swap == 1 ? 'Active' : 'Deactive' }}</td>
                     @if(in_array("write", explode(',',$AdminProfiledetails->commissionsetting))) 
                    <td><a href="{{ url('/admin/commissionsettings', Crypt::encrypt($commission->id)) }}" class="btn btn-success"> <i class="zmdi zmdi-edit"></i> View / Edit</a></td>
                    @endif
                    
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No Commissions Settings' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $commissions->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection