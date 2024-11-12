@php
    $atitle = 'userscommission';
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>View User Details</h1>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                        <br /><br />
                        @if (session('updated_status'))
                            <div class="alert alert-success">
                                {{ session('updated_status') }}
                            </div>
                        @endif


                        @if (session('updated_error'))
                            <div class="alert alert-danger">
                                {{ session('updated_error') }}
                            </div>
                        @endif

                        <div class="tab-container">

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/users_edit/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">User Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/transactionall/' . Crypt::encrypt($userdetails->id) . '/BTC') }}"
                                        role="tab">Transactions</a>
                                </li>

                              

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/admin/userkyc/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">KYC</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/users_wallet/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Wallet</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/userdeposit/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Coin Deposit</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/user_withdraw/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Coin Withdraw</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/userfiatdeposit/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Currency Deposit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/user_fiat_withdraw/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Currency Withdraw</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/user_buy_tradehistory/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Buy trade</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('/admin/user_sell_tradehistory/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Sell trade</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active"
                                        href="{{ url('/admin/user_commissions/' . Crypt::encrypt($userdetails->id)) }}"
                                        role="tab">Commission Settings</a>
                                </li>

                            </ul>

                            </br>
                        </div>


                        <form method="post" action="{{ url('admin/update_user_commission') }}" autocomplete="off">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $userdetails->id }}" name="id">
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Trade Commission</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="trade_commission" class="form-control"
                                            value="{{ isset($data->trade_commission)  ? $data->trade_commission :0  }}"  step="0.01" /><i class="form-group__bar"></i>
                                        @if ($errors->has('trade_commission'))
                                            <span class="help-block">
                                                <strong class="text text-danger">{{ $errors->first('trade_commission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                                <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Swap Commission</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="swap_commission" class="form-control"
                                            value="{{ isset($data->swap_commission)  ? $data->swap_commission :0  }}"  step="0.01"/><i class="form-group__bar"></i>
                                        @if ($errors->has('swap_commission'))
                                            <span class="help-block">
                                                <strong class="text text-danger">{{ $errors->first('swap_commission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                                <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Withdraw Commission</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="withdraw_commission" class="form-control"
                                            value="{{ isset($data->withdraw_commission)  ? $data->withdraw_commission :0  }}"  step="0.01" /><i class="form-group__bar"></i>
                                        @if ($errors->has('withdraw_commission'))
                                            <span class="help-block">
                                                <strong class="text text-danger">{{ $errors->first('withdraw_commission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            

                            <div class="form-group">
                                <button type="submit" name="edit" class="btn btn-light"><i class=""></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    @endsection
