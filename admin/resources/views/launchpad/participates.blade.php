@php
$atitle ="participates-launchpad";
@endphp
@extends('layouts.header')
@section('title', 'P2B Launchpad')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>IEO Participates</h1>
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
                    <th>Asset One</th>
                    <th>Asset Two</th>
                    <th>Trans ID</th>
                    <th>Price</th>
                    <th>Volume</th>
                    <th>Total</th>
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
                @forelse($trans as $key => $tran)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ ucfirst($tran['name']	) }}</td>
                    <td>{{ $tran['coinone'] }}</td>
                    <td>{{ $tran['cointwo'] }}</td>
                    <td>{{ $tran['trans_id'] }}</td>
                    <td>{{ $tran['price'] }}</td>
                    <td>{{ $tran['volume'] }}</td>
                    <td>{{ $tran['total'] }}</td>
                    <td>{{ $tran['status'] }}</td>         
                    <td>{{ date('d/m/Y H:i:s', strtotime($tran['created_at'])) }}</td>         
                    @php
                 $i++;
                 @endphp
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No List Available' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $ieoTrans->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection