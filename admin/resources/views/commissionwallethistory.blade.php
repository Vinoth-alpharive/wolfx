@php
$atitle ="commission_wallet_history";
@endphp
@extends('layouts.header')
@section('title', 'Commission Wallet History')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Admin Wallet History</h1>
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
                    <!-- <th>Address</th> -->
                    <th>Balance</th>
                    <th>Withdraw Commission</th>
                    <th>Swap</th>
                    <th>Buy Trade</th>
                    <th>Sell Trade</th>
                    <th>Trade</th>
                    
                  </tr>
                </thead>
                <tbody> 
                @forelse($history as $key => $value)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->currency }}</td>
                    <!-- <th>{{ $value->mukavari !='' ? $value->mukavari : 0 }}</th> -->
                    <td>{{ number_format($value->balance,8) }}</td>
                    <td>{{ number_format($value->commission,8) }}</td>
                    <td>{{ $value->instant_type !='' ? $value->instant_type :0 }}</td>
                    <td>{{ number_format($value->buytrade, 8) }}</td>
                    <td>{{ number_format($value->selltrade, 8) }}</td>
                    <td>{{ number_format($value->trade, 8) }}</td>
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No Commissions Wallet History' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $history->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection