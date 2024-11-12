@php
$atitle ="apply-launchpad";
@endphp
@extends('layouts.header')
@section('title', 'Applied Projects')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Applied projects</h1>
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
                    {{-- <th>Telegram Name</th> --}}
                    <th>Date & time</th>
                    <th>Project Name</th>
                    <th>Token Ticker</th>
                    <th>Email</th>
                    <th>Project Website</th>
                    <th>Coinmarketcap/Coingecko URL </th>
                    <th>Token / coin</th>
                    <th>Contract</th>
                    <th>Phone Number</th>
                    <th>Social channel link</th>
                    <th>Telegram contact</th>
                    <th>Describe project</th>
                    
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
                @forelse($projects as $key => $project)
                  <tr>
                    <td>{{ $i }}</td>
                    {{-- <td>{{ $project->telegram_username }}</td> --}}
                    <td>{{ date('d/m/Y H:i:s', strtotime($project->created_at)) }}</td>
                    <td>{{ ucfirst($project->project_name) }}</td>
                    <td>{{ ucfirst($project->token_ticker) }}</td>
                    <td>{{ $project->email }}</td> 
                    <td>{{ $project->website }}</td> 
                    <td>{{ $project->coin_market_gap_url }}</td>
                    <td>{{ $project->coin }}</td>        
                    <td>{{ $project->contract }}</td> 
                    <td>{{ $project->phone_no }}</td> 
                    <td>{{ $project->social_channel_links }}</td>
                    <td>{{ $project->telegram_contact }}</td>
                    <td>{{ $project->describe_project }}</td>
                                     
                    @php
                 $i++;
                 @endphp
                  </tr>
                  @empty
                   <tr><td colspan="7"> {{ 'No List Available' }}!</td></tr>
                @endforelse
                </tbody>
              </table>
              {{ $projects->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection