@php
if($userdetails->user_type == 'Buyer') {
$atitle = "buyer";
} else {
$atitle = "seller";
}
@endphp

@extends('layouts.header')
@section('title', ' Users Wallet')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>User Wallet</h1>
    </header>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    @if($userdetails->user_type == 'Buyer')
                    <a href="{{ url('admin/buyer') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    @else
                    <a href="{{ url('admin/seller') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    @endif

                    </br>

                    @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif


                    @if(session('error'))
                    <div class="alert alert-warning">
                        {{ session('error') }}
                    </div>
                    @endif
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
                                <a class="nav-link active" href="{{ url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Wallet</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Deposit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/user_withdraw/'.Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Withdraw</a>
                            </li>

                        </ul>

                        </br>
                    </div>
                    </br>
                    <form action="{{ url('/admin/Balance_update') }}" method="POST">
                        {{ csrf_field() }}
                        @foreach($coins as $coin)
                        @if($coin->type != 'fiat')
                        @if($coin->source == 'USDT' || $coin->source == 'TRX')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{$coin->source}} Address</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    @if(isset($balance[$coin->source]['address']) && $balance[$coin->source]['address'] !="")
                                    <input type="text" name="from_address" class="form-control" value="{{ $balance[$coin->source]['address'] }}" readonly><i class="form-group__bar"></i>
                                    @else
                                    <input type="text" name="from_address" class="form-control" value="No Address" readonly><i class="form-group__bar"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif

                        @if($coin->source == 'USDT' || $coin->source == 'TRX')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{$coin->source}} Available Balance</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    @if(isset($balance[$coin->source]['balance']) && $balance[$coin->source]['balance'] > 0)

                                    @if($coin->source == 'NGN')
                                    <input type="number" name="balance_{{$coin->source}}" class="form-control" value="{{ display_format($balance[$coin->source]['balance'],0) }}" step="0.00001" min="0" max="100000000" readonly><i class="form-group__bar"></i>
                                    @else
                                    <input type="number" name="balance_{{$coin->source}}" class="form-control" value="{{ $balance[$coin->source]['balance'] }}" step="0.00001" min="0" max="100000000" readonly><i class="form-group__bar"></i>
                                    @endif
                                    @else
                                    <input type="number" name="balance_{{$coin->source}}" class="form-control" value="0" step="0.00001" min="0" max="100000000" readonly><i class="form-group__bar"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </form>
                    <h4>Balance update:</h4>
                    <form action="{{ url('/admin/Balance_update') }}" method="POST">
                        {{ csrf_field() }}

                        </br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coin/Currency</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <select class="form-control" name="coin">
                                        <option value="">Select coin/currency</option>
                                        <option value="USDT">USDT</option>
                                        <option value="TRX">TRX</option>
                                    </select>
                                    @if ($errors->has('coin'))
                                    <span class="help-block error-msg">
                                        <strong>{{ $errors->first('coin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <input type="number" name="amount" class="form-control" value="" step="0.00001" min="0" max="100000000"><i class="form-group__bar"></i>

                                    <input type="hidden" name="uid" value="{{ $userdetails->id }}">



                                    @if ($errors->has('amount'))
                                    <span class="help-block error-msg">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Remark</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <input type="text" name="remark" class="form-control"><i class="form-group__bar"></i>

                                    @if ($errors->has('remark'))
                                    <span class="help-block error-msg">
                                        <strong>{{ $errors->first('remark') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-success btn-xs" type="submit" name="submit" value="Update">

                    </form>
                </div>




            </div>

        </div>
    </div>
    @endsection
