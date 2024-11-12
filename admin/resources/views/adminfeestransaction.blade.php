@php
$atitle ="adminfeestransaction";
@endphp
@extends('layouts.header')
@section('title', 'Transaction History')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Transaction History</h1>
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
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Fee</th>
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
                    <td>{{ \App\Models\User::where('id',$value->uid)->value('first_name').' '. \App\Models\User::where('id',$value->uid)->value('last_name') }}</td>
                    <td>{{ $value->type }}</td>
                    @if($value->type =='trade')
                    <td>{{ $value->price }}</td> 
                    <td>{{ $value->quantity }}</td>   
                    @else
                    <td>-</td> 
                    <td>-</td>  
                    @endif                   
                    <td>{{ $value->value   }}</td>                 
                    <td>{{ display_format($value->fee,8) }}</td>                 

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