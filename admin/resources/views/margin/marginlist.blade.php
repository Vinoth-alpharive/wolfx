@php
$atitle ="borrow-list";
@endphp
@extends('layouts.header')
@section('title', 'Borrow History')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Borrow History</h1>
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
                    <th>User</th>
                    <th>Pair</th>
                    <th>Trade ID</th>
                    <th>Price</th>
                    <th>Volume</th>
                    <th>Borrowed</th>
                    <th>Total Interest</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Date & Time</th>
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
                @forelse($borrows as $borrow)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ ucfirst($users[$borrow->uid]) }}</td>
                    <td>{{ $pairs[$borrow->pair] }}</td>
                    <td>{{ $borrow->trade_id }}</td>
                    <td>{{ display_format($borrow->price,4) }}</td>
                    <td>{{ display_format($borrow->qty) }}</td>
                    <td>{{ $borrow->borrowed_amount }}</td>
                    <td>{{ ncSub($borrow->total_repay_amount,$borrow->user_repayed_amount) }}</td>
                    <td>{{ $borrow->user_repayed_amount }}</td>
                    <td>{{ ($borrow->status == 1)? 'Completed' : 'Pending' }}</td>         
                    <td>{{ date('d/m/Y H:i:s', strtotime($borrow->created_at)) }}</td>    
                    @php
                      $i++;
                    @endphp
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No List Available' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $borrows->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection