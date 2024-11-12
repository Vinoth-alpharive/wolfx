@extends('layouts.header')
@section('title', 'Affiliate Commission Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Affiliate Commission Settings</h1>
    </header>
    <div class="row">
     
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('admin/add_commission') }}" class="btn btn-info">Add</a> <br/>
            <div class="table-responsive">
           
              @if(count($commissions))
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Token</th>
                    <th>Generation</th>
                    <th>Staking Commission</th>
                    <th>Title</th>
                    @if(in_array("write",explode(',',$AdminProfiledetails->refferalcommission)))
                    <th>Status</th>
                    @endif
                  </tr>
                </thead>
                <tbody> 
                 @php 
                  $i =1;
                    $limit=20;
                    if(isset($_GET['page'])){
                $page = $_GET['page'];
                $i = (($limit * $page) - $limit)+1;
              }else{
                $i =1;
              }        
            @endphp 
                @foreach($commissions as $key => $commission)
                  <tr>
                    <td>{{ $i }}</td>
                    {{-- <td>{{ $key+1 }}</td> --}}
                    <td>{{ $commission->coin }}</td>
                    <td>Level {{ $commission->generation }}</td>
                    <td>{{ $commission->stake }}%</td>
                    <td>{{ str_replace('_',' ', strtoupper($commission->title)) }}</td>
                     @if(in_array("write",explode(',',$AdminProfiledetails->refferalcommission)))
                    <td><a href="{{ url('/admin/aff_commissionsettings', Crypt::encrypt($commission->id)) }}" class="btn btn-info">View / Edit</a></td>
                    @endif
                  </tr>
                    @php    
                 $i++;
                 @endphp
                @endforeach
                </tbody>
              </table>
              {{ $commissions->links() }}
              @else
                {{ 'No Commissions Settings' }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection