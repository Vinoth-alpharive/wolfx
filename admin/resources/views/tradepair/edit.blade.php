@php
$atitle ="coinlist";
@endphp
@extends('layouts.header')
@section('title', 'Coins Settings')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Token Edit Page</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('admin/coinlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Coins list</a>
                    <br /><br />
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                    </div>
                    @endif
                    <form method="post" action="{{ url('admin/coinupdate') }}" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $commission->id }}" name="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Source</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="symbol" class="form-control" value="{{ $commission->source != NULL ? $commission->source : '0' }}"><i class="form-group__bar"></i>
                                    @if ($errors->has('symbol'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('symbol') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Withdraw Commission (%)</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="withdraw" class="form-control" step="0.01" min="0" max="10000000" value="{{ $commission->withdraw != NULL ? $commission->withdraw : '0' }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('withdraw'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('withdraw') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Withdraw Commission Type</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="com_type" class="form-control">


                                        <option <?php if ($commission->com_type == "Percentage") echo "selected"; ?> value="Percentage">Percentage</option>
                                        <option <?php if ($commission->com_type == "Fixed") echo "selected"; ?> value="Fixed">Fixed</option>
                                    </select>
                                    @if ($errors->has('com_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('com_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Wallet Page Redirect URL</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="walletpair" class="form-control" value="{{ $commission->walletpair != NULL ? $commission->walletpair : '' }}" required ><i class="form-group__bar"></i>
									@if ($errors->has('walletpair'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('walletpair') }}</strong>
					                    </span>
					                @endif
								</div>
							</div>
						</div> -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" {{ $errors->has('type') ? ' has-error' : '' }}>

                                    <select name="type" id="coin_type" class="form-control">
                                        <option value="token" {{  $commission->type == 'token' ? 'selected' : '' }}>Token</option>
                                        <option value="bsctoken" {{  $commission->type == 'bsctoken' ? 'selected' : '' }}>Bep20 Token</option>
                                        <option value="trxtoken" {{  $commission->type == 'trxtoken' ? 'selected' : '' }}>TRC20 Token</option>
                                        <option value="erctoken" {{  $commission->type == 'erctoken' ? 'selected' : '' }}>ERC20 Token</option>
                                        <option value="polytoken" {{  $commission->type == 'polytoken' ? 'selected' : '' }}>POLY20 Token</option>
                                    </select>
                                    @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row" id="contract" style="display: none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Contract Address</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="contractaddress" class="form-control" value="" />{{ $commission->contractaddress != NULL ? $commission->contractaddress : "" }}</textarea><i class="form-group__bar"></i>
                                    @if ($errors->has('contractaddress'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contractaddress') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row" id="abi" style="display: none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Abi array</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="abiarray" class="form-control" value="" />{{ $commission->abiarray != NULL ? $commission->abiarray : 0 }}</textarea><i class="form-group__bar"></i>
                                    @if ($errors->has('abiarray'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('abiarray') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coin name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="coinname" class="form-control" value="{{ $commission->coinname != NULL ? $commission->coinname : '-' }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('coinname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('coinname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="netfee" class="form-control" value="0" />
                        <!-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Net fee</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="netfee" step="0.00001" min="0" max="10000000" class="form-control" value="{{ $commission->netfee != NULL ? $commission->netfee : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('netfee'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('netfee') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>
 -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Point digit</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="digit" min="0" max="100" class="form-control" value="{{ $commission->point_value != NULL ? $commission->point_value : '-' }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('digit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('digit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Contract Decimal value</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="decimal_value" min="0" max="100" class="form-control" value="{{ $commission->decimal_value != NULL ? $commission->decimal_value : '-' }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('decimal_value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('decimal_value') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Live url(Optional)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="url" class="form-control" value="{{ $commission->url != NULL ? $commission->url : '-' }}"/><i class="form-group__bar"></i>
                        @if ($errors->has('url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                        @endif
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Minimum deposit</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="number" name="min_deposit" class="form-control" value="{{ $commission->min_deposit != NULL ? $commission->min_deposit : '-' }}" /><i class="form-group__bar"></i>
                    @if ($errors->has('min_deposit'))
                    <span class="help-block">
                        <strong>{{ $errors->first('min_deposit') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Minimum withdraw</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="number" name="min_withdraw" class="form-control" value="{{ $commission->min_withdraw != NULL ? $commission->min_withdraw : '-' }}" /><i class="form-group__bar"></i>
                    @if ($errors->has('min_withdraw'))
                    <span class="help-block">
                        <strong>{{ $errors->first('min_withdraw') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>



        {{-- <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Ranking</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="ranking" class="form-control" value="{{ $commission->ranking != NULL ? $commission->ranking : '-' }}" /><i class="form-group__bar"></i>
                    @if ($errors->has('ranking'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ranking') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Deposit Status</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="is_deposit" class="form-control">
                        <option value="1" {{ $commission->is_deposit == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $commission->is_deposit == '0' ? 'selected' : '' }}>Deactive</option>

                    </select>
                    @if ($errors->has('is_deposit'))
                    <span class="help-block">
                        <strong>{{ $errors->first('is_deposit') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Withdraw Status</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="is_withdraw" class="form-control">
                        <option value="1" {{ $commission->is_withdraw == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $commission->is_withdraw == '0' ? 'selected' : '' }}>Deactive</option>
                    </select>
                    @if ($errors->has('is_withdraw'))
                    <span class="help-block">
                        <strong>{{ $errors->first('is_withdraw') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>







        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8">
                <!-- <div class="loding">Loading...</div> -->
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <div class="form-group  has-feedback">
                        <div class="col-xs-12 inputGroupContainer"> <img src="{{ \Config::get('app.siteurl')}}/images/color/{{ $commission['image'] }}" id="doc1" width="36px" height="36px" class="img-responsive kyc_img_cls" />
                            <label for="file-upload1" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload Image </label>
                            <input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)" name="image" type="file" style="display:none;">
                            <label id="file-name1"></label>
                            <br />
                            <br />
                            @if ($errors->has('image')) <span class="help-block"> <strong>{{ $errors->first('image') }}</strong> </span><br /> @endif
                            <p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only png image format 35 X 35</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Active Status</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="1" {{ $commission->shown == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $commission->shown == '0' ? 'selected' : '' }}>Deactive</option>

                    </select>
                    @if ($errors->has('status'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>


        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Is Swap</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="is_swap" class="form-control" >
									<option value="1" {{ $commission->is_swap == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $commission->is_swap== '0' ? 'selected' : '' }}>Deactive</option>

        </select>
        @if ($errors->has('is_swap'))
        <span class="help-block">
            <strong>{{ $errors->first('is_swap') }}</strong>
        </span>
        @endif
    </div>
    </div>
    </div> --}}


    <div class="form-group">
        <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    @endsection
