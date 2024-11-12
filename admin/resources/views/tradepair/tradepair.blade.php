@php
$atitle ="tradepair";
@endphp
@extends('layouts.header')
@section('title', 'Tradepair Setting')
@section('content')
<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Tradepair Settings</h1>
        </header>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        <a href="{{url('/admin/addpair')}}" class="btn btn-info">Add Trade Pair</a>
                        <div class="table-responsive">


                            <form action="{{ url('/admin/trade/search') }}" method="get" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="searchitem" class="form-control" placeholder="Search for symbol" value="" required="" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" class="btn btn-success user_date" value="Search" />
                                        <a class="btn btn-warning btn-xs" href="{{ url('admin/tradepairlist') }}"> Reset </a>
                                    </div>
                            </form>
                            <div class="col-md-3">
                                <a class="btn btn-warning" href="{{ route('userexport') }}">Export To Excel</a>
                            </div>
                        </div>

                        <br />


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Coinone</th>
                                    <th>Cointwo</th>
                                    <th>symbol</th>
                                    <th>Buy Commission</th>
                                    <th>Sell Commission</th>
                                    <th>Status</th>
                                    @if(in_array("write", explode(',',$AdminProfiledetails->tradepair)))
                                    <th>Action</th>
                                    @endif
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
                                @forelse($tradepair as $key => $value)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $value->coinone }}</td>
                                    <td>{{ $value->cointwo }}</td>
                                    <td>{{ $value->symbol }}</td>
                                    <td>{{ $value->buy_trade }}</td>
                                    <td>{{ $value->sell_trade }}</td>
                                    {{-- <td>@if($value->is_dust == 1)Binance @elseif($value->is_dust == 2)Wazirx @else No @endif</td> --}}
                                    <td>{{ $value->active == 1 ? 'Active' : 'Deactive' }}</td>
                                    @if(in_array("write", explode(',',$AdminProfiledetails->tradepair)))
                                    <td><a href="{{ url('/admin/pairedit', Crypt::encrypt($value->id)) }}" class="btn btn-info">View / Edit</a>
                                        @endif
                                        <a href="{{ url('/admin/pairdelete', Crypt::encrypt($value->id)) }}" class="btn btn-info">Delete</a></td>
                                </tr>
                                @php $i++; @endphp
                                @empty
                                <tr>
                                    <td colspan="7"> {{ 'No List Settings' }}!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $tradepair->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
