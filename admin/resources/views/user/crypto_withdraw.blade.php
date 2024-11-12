@php
if($userdetails->user_type == 'Buyer') {
$atitle = "buyer";
} else {
$atitle = "seller";
}
@endphp

@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Coin Withdraw History</h1>
    </header>
    @if(session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($userdetails->user_type == 'Buyer')
                    <a href="{{ url('admin/buyer') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    @else
                    <a href="{{ url('admin/seller') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    @endif
                    <br /><br />
                    <div class="tab-container">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/users_edit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">User Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC') }}" role="tab">Transactions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/users_referral/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Referral</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Wallet</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Deposit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/admin/user_withdraw/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Withdraw</a>
                            </li>

                        </ul>

                        </br>
                    </div>

                    <div class="table-responsive search_result">
                        <table class="table" id="dows">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Date & Time</th>
                                    <th>Coin Name</th>
                                    <th>Txn ID</th>
                                    <th>Sender</th>
                                    <th>Recipient</th>
                                    <th>Amount</th>
                                    <th>Admin Fee</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($transaction) > 0)
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
                                @foreach($transaction as $transactions)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('Y/m/d h:i:s', strtotime($transactions->created_at)) }}</td>
                                    <td>{{ $transactions->coin_name }}</td>
                                    <td>{{ $transactions->transaction_id }}</td>
                                    <td>{{ $transactions->sender }}</td>
                                    <td>{{ $transactions->reciever }}</td>
                                    <td>{{ number_format($transactions->amount, 8, '.', '') }}</td>
                                    <td>{{ number_format($transactions->admin_fee, 8, '.', '') }}</td>
                                    <td>
                                        @if($transactions->status == 0)
                                        <a class="btn btn-success btn-xs" href="{{ url('/admin/crypto_withdraw_edit/'.\Crypt::encrypt($transactions->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
                                        @elseif($transactions->status == 2) Cancelled
                                        @elseif($transactions->status == 1)
                                        Success
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10"> No record found!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="pagination-tt clearfix">
                                @if($transaction->count())
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
