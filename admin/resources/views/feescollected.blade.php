@php
$atitle ="feescollected";
@endphp
@extends('layouts.header')
@section('title', 'Fees Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Fees Settings</h1>
      <a href="{{ url('/admin/adminfeestransaction')}}" class="btn btn-info" style="float: right">View Commission History</a>
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
                    <th>Currency</th>
                    <th>Commision</th>
                  </tr>
                </thead>
                <tbody>
                @php 
                    $i =1;
                    $limit=10;
                    if(isset($_GET['page'])){
                      $page = $_GET['page'];
                      $i = (($limit * $page) - $limit)+1;
                    }else{
                       $i =1;
                    }        
                @endphp 
                @forelse($data as $key => $value)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $value->currency }}</td>
                    <td>{{ $value->commission }}</td>                 
                  </tr>
                  @php $i++; @endphp
                  @empty
                   <tr><td colspan="7"> {{ 'No List Settings' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $data->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection