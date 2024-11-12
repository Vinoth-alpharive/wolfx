@php
$atitle ="commission_history";
@endphp
@extends('layouts.header')
@section('title', 'Commission History')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Commission History</h1>
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
                    <th>User Email</th>
                    <th>Coin / Currency</th>
                    <th>Type</th>
                    <th>Trade Type</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Value</th>
                    <th>Fee</th>
                    <th>Commission (%)</th>
                    
                  </tr>
                </thead>
                <tbody> 
                @forelse($history as $key => $value)
                  <tr>
        <?php //echo "<pre>";print_r($value->user);exit;?>
                    
                    <td>{{ $key+1 }}</td>
                    <td>{{ isset($value->user->email) ? $value->user->email : '-' }}</td>
                    <td>{{ $value->coin }}</td>
                    <td>{{ $value->type }}</td>
                    <td>{{ $value->trade_type }}</td>
                    <td>{{ number_format($value->amount,8) }}</td>
                    <td>{{ number_format($value->price,8) }}</td>
                    <td>{{ number_format($value->quantity,8) }}</td>
                    <td>{{ number_format($value->value,8) }}</td>
                    <td>{{ number_format($value->fee,8) }}</td>
                    <td>{{ number_format(ncMul($value->commission,100),8) }}</td>
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No Commissions History' }}!</td></tr>
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