@php
$atitle ="bittrex";
@endphp
@extends('layouts.header')
@section('title', 'Bittrex Admin Wallet')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Bittrex Admin Wallet</h1>
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
                    <th>Balance</th>
                    <th>Available</th>
                    <th>Pending</th>
                    <th>CryptoAddress</th>
                  </tr>
                </thead>
                <tbody> 
                @php 
                $i = 1;
                @endphp
                @foreach($data->result as $key => $commission)
                @if($commission->Currency != 'BTXCRD')
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $commission->Currency }}</td>
                    <td>{{ $commission->Balance }}</td>
                    <td>{{ $commission->Available }}</td>
                    <td>{{ $commission->Pending }}</td>
                    <td>{{ $commission->CryptoAddress }}</td>                   
                  </tr>
                @php 
                $i = $i+1;
                @endphp                 
                @endif
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection