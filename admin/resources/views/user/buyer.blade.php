@php
$atitle ="buyer";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Buyer</h1>
    </header>
    <div class="col-md-4">

        <a class="btn btn-success btn-xs" href="{{ url('/admin/addbuyer') }}"> <i class="zmdi zmdi-edit"></i> Add Buyer </a>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($message = Session::get('updated_status'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <form action="{{ url('/admin/users/search') }}" method="get" autocomplete="off">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="searchitem" class="form-control" placeholder="Search for User Name or Email" value="" required="" />
                        <input type="hidden" name="type" value="Buyer" />
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-success user_date" value="Search" />
                        <a class="btn btn-warning btn-xs" href="{{ url('admin/buyer') }}"> Reset </a>
                    </div>
            </form>
            <div class="col-md-3">
                <a class="btn btn-warning" href="{{ route('buyerexport') }}">Export To Excel</a>
            </div>
        </div>
        <br />
        <div class="table-responsive search_result">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.NO </th>
                        <th>Date and Time</th>
                        <th>Username</th>
                        <th>Price</th>
                        @if(in_array("write", explode(',',$AdminProfiledetails->userlist)))
                        <th colspan="1">Action</th>
                        @endif
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
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ date('Y/m/d h:i:s', strtotime($user->created_at)) }}</td>
                        <td>{{ $user->username}}</td>
                        <td>{{ $user->price }}</td>
                        @if(in_array("write", explode(',',$AdminProfiledetails->userlist)))
                        <td><a class="btn btn-success btn-xs" href="{{ url('/admin/users_edit/'.Crypt::encrypt($user->id)) }}"><i class="zmdi zmdi-edit"></i> View </a></td>
                        @endif
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @empty
                    <tr>
                        <td colspan="7"> No record found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if(count($users) > 0)
                    {!! $users->appends(Request::only(['searchitem'=>'searchitem']))->render() !!}
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
