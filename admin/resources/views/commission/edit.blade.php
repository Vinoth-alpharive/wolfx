@php
$atitle ="commission";
@endphp
@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Commission Settings</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('admin/commission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Commission</a>
                    <br /><br />
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                    </div>
                    @endif
                    @if(session('statuserror'))
                    <div class="alert alert-danger	" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failure!</strong> {{ session('statuserror') }}
                    </div>
                    @endif
                    <form method="post" action="{{ url('admin/commissionupdate') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $commission->id }}" name="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coin / Token</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="currency" class="form-control" value="{{ $commission->source != NULL ? $commission->source : '0' }}" readonly /><i class="form-group__bar"></i>
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
                                    <input type="number" name="withdraw" class="form-control" step="0.01" min="0" max="10000000" value="{{ $commission->withdraw != NULL ? display_format($commission->withdraw,8) : '0' }}" /><i class="form-group__bar"></i>
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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Minimum deposit amount</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="min_deposit" step="0.00001" min="0" max="10000000" class="form-control" value="{{ $commission->min_deposit != NULL ? display_format($commission->min_deposit,8) : 0 }}" /><i class="form-group__bar"></i>
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
                                    <label>Minimum withdraw amount</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="min_withdraw" step="0.00001" min="0" max="10000000" class="form-control" value="{{ $commission->min_withdraw != NULL ? display_format($commission->min_withdraw,8) : 0 }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('min_withdraw'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('min_withdraw') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>withdraw Perday Limit</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="perday_withdraw" step="0.00001" min="0" max="10000000" class="form-control" value="{{ $commission->perday_withdraw != NULL ? display_format($commission->perday_withdraw,8) : 0 }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('perday_withdraw'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perday_withdraw') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Decimal Point</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="decimal_point" class="form-control" value="{{ $commission->decimal_point != NULL ? $commission->decimal_point : '' }}" /><i class="form-group__bar"></i>

								</div>
							</div>
						</div> -->



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Net fee</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="netfee" step="0.00001" min="0" max="10000000" class="form-control" value="{{ $commission->netfee != NULL ? display_format($commission->netfee,8) : 0 }}" /><i class="form-group__bar"></i>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Deposit Status</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="is_deposit" class="form-control">
                                        <option value="1" @if($commission->is_deposit === 1) selected @endif>Active</option>
                                        <option value="0" @if($commission->is_deposit === 0) selected @endif>Deactive</option>

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
                                        <option value="1" @if($commission->is_withdraw === 1) selected @endif>Active</option>
                                        <option value="0" @if($commission->is_withdraw === 0) selected @endif>Deactive</option>

                                    </select>
                                    @if ($errors->has('is_withdraw'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_withdraw') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
