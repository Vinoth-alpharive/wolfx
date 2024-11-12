@php
$atitle ="welcomerewards";
@endphp
@extends('layouts.header')
@section('title', 'Welcome Rewards')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Welcome Rewards</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
                <a href="{{ url('/admin/newreward') }}" class="btn btn-info">Add Welcome Reward</a>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button><strong>Success!</strong>
                {{ session('status') }}
                </div>
                @endif
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Date</th>
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
                @forelse($welcome_rewards as $key => $reward)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ ucfirst($reward->title) }}</td>
                    <td>{{ ucfirst($reward->description	) }}</td>
                    <td><img src="{{ \Config::get('app.siteurl') }}/images/color/{{ $reward->image }}" width="50" height="50" alt=""></td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($reward->created_at)) }}</td>         
                    <td><a href="{{ url('/admin/viewreward', Crypt::encrypt($reward->id)) }}" class="btn btn-info">View / Edit</a>
                    <a href="{{ url('/admin/deletereward', Crypt::encrypt($reward->id)) }}" class="btn btn-info">Delete</a> 
                    <!-- <form action="{{ url('/deleteoffer',['id'=>\Crypt::encrypt($reward->id)]) }}"><input type="submit" value="Delete"/></form></td>                -->
                    @php
                 $i++;
                 @endphp
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No List Available' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $welcome_rewards->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection