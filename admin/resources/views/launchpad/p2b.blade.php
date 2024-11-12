@php
$atitle ="p2b-launchpad";
@endphp
@extends('layouts.header')
@section('title', 'P2B Launchpad')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>IEO Launchpad</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
                <a href="{{ url('/admin/addlaunchpad') }}" class="btn btn-info">Add Launchpad</a>
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Symbol</th>
                    <th>Network</th>
                    <th>Total supply per session</th>
                    <th>Discount(%)</th>
                    {{-- <th>Whitepaper</th>
                    <th>Presentation</th> --}}
                    <th>Start Date</th>
                    <th>End Date</th>
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
                @forelse($ieoTokens as $key => $token)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $token->symbol }}</td>
                    <td>{{ ucfirst($token->protocol_network	) }}</td>
                    <td>{{ $token->supply_per_session }}</td>
                    <td>{{ ($token->discount) ? $token->discount : 0}}</td>
                    {{-- <td>{{ $token->whitepaper }}</td>
                    <td>{{ $token->presentation }}</td> --}}
                    <td>{{ date('d/m/Y H:i:s', strtotime($token->start_date)) }}</td>         
                    <td>{{ date('d/m/Y H:i:s', strtotime($token->end_date)) }}</td>         
                    <td><a href="{{ url('/admin/viewlaunchpad', Crypt::encrypt($token->id)) }}" class="btn btn-info">View / Edit</a></td>               
                    @php
                 $i++;
                 @endphp
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No List Available' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $ieoTokens->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection