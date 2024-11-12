@php
$atitle ="dashboard";
@endphp
@extends('layouts.header')
@section('title', 'Admin Dashboard')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>dashboard</h1>
    </header>
    <div class="row quick-stats listview2">
        @if(in_array("buyers", explode(',',$AdminProfiledetails->dashboard)))
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

        <a style="font-size: 20px;" href="{{url('/admin/buyer')}}">

            <div class="quick-stats__item">

                <div class="quick-stats__info col-md-8">
                    <h2>{{ $details['buyer'] }}</h2>
                     <small style="font-size: 20px; color:#fff">Buyer's</small> 
                </div>
                <div class="col-md-4 text-right">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            </a>
        </div>
        @endif
        @if(in_array("sellers", explode(',',$AdminProfiledetails->dashboard)))
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <a style="font-size: 20px;" href="{{ url('admin/seller') }}"> 
            <div class="quick-stats__item">
                <div class="quick-stats__info col-md-8">
                    <h2>{{ $details['seller'] }}</h2>
                   <small style="font-size: 20px; color:#fff">Seller's</small> 
                </div>
                <div class="col-md-4 text-right">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            </a>
        </div>
        @endif
        {{-- <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
        <a style="font-size: 20px;" href="{{ url('admin/pending_tradehistory/all/Sell') }}"> 
            <div class="quick-stats__item">
                <div class="quick-stats__info col-md-8">
                    
                    <h2>{{ $details["Request Orders"] }}</h2>
                   <small style="font-size: 20px; color:#fff">Request Order's</small>
                </div>
                <div class="col-md-4 text-right">
                    <h1><i class="fa fa-shopping-bag" aria-hidden="true"></i></h1>
                </div>
            </div>
            </a>
        </div> --}}

        {{-- <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <a href="{{url('admin/support')}}"> 
            <div class="quick-stats__item">
                <div class="quick-stats__info col-md-8">
                    <h2>{{ $details['chat'] }}</h2>
                    <small style="font-size: 20px; color:#fff">Unread Support Tickets</small>
                </div>
                <div class="col-md-4 text-right">
                    <h1><i class="zmdi zmdi-ticket-star"></i></h1>
                </div>
            </div>
            </a>
        </div> --}}

    </div>

    <div class="row">
        <div class="col-md-6">
        
            <div class="card">
                @if(in_array("coinrequest", explode(',',$AdminProfiledetails->dashboard)))
                <div class="card-body">
                    <h4 class="card-title">Recent Coin Withdraw Request (Pending)</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>User Name</th>
                                    <th>Coin/Token</th>
                                    <th>Amount</th>
                                    <th>Withdraw Fee</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($details['withdraw_request']))
                                @foreach($details['withdraw_request'] as $withdraw_requests)
                                <tr>
                                    <td>{{ date('m-d-Y H:i:s', strtotime($withdraw_requests->created_at)) }}</td>
                                    <td>{{username($withdraw_requests->uid)}}</td>
                                    <td>{{ $withdraw_requests->coin_name }}</td>
                                    <td>{{ display_format($withdraw_requests->amount, 8, '.', '') }}</td>
                                    <td>{{ display_format($withdraw_requests->admin_fee, 8, '.', '') }}</td>
                                    <td>Awaiting Confirmation </td>
                                    <td><a class="btn btn-success btn-xs" href="{{ url('/admin/crypto_withdraw_edit'.'/'.Crypt::encrypt($withdraw_requests->id)) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6"> No Record Found!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(in_array("userdetails", explode(',',$AdminProfiledetails->dashboard)))
        <div class="col-md-6">
            <div class="card widget-past-days">
                <div class="card-body">
                    <h4 class="card-title">User Details</h4>
                </div>
                <div class="listview listview--bordered listview1">
                    <div class="listview__item">
                        <div class="widget-past-days__info col-md-8"> <a href="{{url('admin/users')}}"> <small>Total Users</small>
                                <h3>{{ $details['totalusers'] }}</h3>
                            </a>
                        </div>
                        <div class="col-md-4 text-right">
                            <h1><i class="zmdi zmdi-accounts-alt"></i></h1>
                        </div>
                    </div>
                    {{-- <div class="listview__item" style="margin-bottom: 12px;">
                                        <div class="widget-past-days__info col-md-8"> <small>KYC Verified Users</small>
                                            <h3>{{ $details['kycverify'] }}</h3>
                </div>
                <div class="col-md-4 text-right">
                    <h1><i class="zmdi zmdi-badge-check"></i></h1>
                </div>
            </div> --}}
        </div>
    </div>
    @endif

    {{-- <div class="card">
        @if(in_array("supportticket", explode(',',$AdminProfiledetails->dashboard)))
        <div class="card-body">
            <h4 class="card-title">Recent Support Ticket</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>User Name</th>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($details['support_ticket']))
                        @foreach($details['support_ticket'] as $support_tickets)
                        <tr>
                            <td>{{ date('m-d-Y H:i:s', strtotime($support_tickets->created_at)) }}</td>
                            <td>{{ username($support_tickets->uid) }}</td>
                            <td>{{ $support_tickets->ticket_id }}</td>
                            <td>{{ $support_tickets->subject }}</td>
                            <td>{{ $support_tickets->message }}</td>
                            <td><a class="btn btn-success btn-xs" href="{{ url('/admin/reply/'.Crypt::encrypt($support_tickets->ticket_id)) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6"> No Record Found!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
     --}}
    </div>
    </div>
</section>
@endsection
