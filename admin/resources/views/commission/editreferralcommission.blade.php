@php
$atitle ="referalcommissionupdate";
@endphp
@extends('layouts.header')
@section('title', 'Coins Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Referal Commission Edit Page</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/referalcommission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Referal Commission list</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/referalcommissionupdate') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $commission->id }}" name="id">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="coin" class="form-control" >
									
                                    @foreach ($coins as $coin)
                                    <option value="{{$coin->source}}" {{$commission->coin == $coin->source ? 'selected' : ''}}>{{$coin->source}}</option>
                                    @endforeach
									</select>
									@if ($errors->has('coin'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('coin') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="amount" class="form-control" value="{{ $commission->amount != NULL ? $commission->amount : "" }}"/><i class="form-group__bar"></i>
									@if ($errors->has('amount'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('amount') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div> 
						</div>
						{{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Role</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="role" class="form-control" >
									<option value="All" {{ $commission->role == 'All' ? 'selected' : '' }}>All</option>
									</select>
									@if ($errors->has('role'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('role') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div> 
						</div>  --}}
						{{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Generation</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="generation" class="form-control" value="{{ $commission->generation != NULL ? $commission->generation : "" }}"/><i class="form-group__bar"></i>
									@if ($errors->has('generation'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('generation') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div> 
						</div> --}}

                        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Deposit</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="deposit" class="form-control" value="{{ $commission->deposit != NULL ? $commission->deposit : "" }}" required/><i class="form-group__bar"></i>
									@if ($errors->has('deposit'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('deposit') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div> 
						</div> --}}

                        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Register</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="register" class="form-control" value="{{ $commission->register != NULL ? $commission->register : "" }}"/><i class="form-group__bar"></i>
									@if ($errors->has('register'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('register') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div> 
						</div> --}}

                        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Stake</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="stake" class="form-control" value="{{ $commission->stake != NULL ? $commission->stake : "" }}" required/><i class="form-group__bar"></i>
									@if ($errors->has('stake'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('stake') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div> 
						</div> --}}

                        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="trade" class="form-control" value="{{ $commission->trade != NULL ? $commission->trade : "" }}" required/><i class="form-group__bar"></i>
									@if ($errors->has('trade'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('trade') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div> 
						</div> --}}

                        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Type</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="type" class="form-control" >
                                        <option value="register" {{ $commission->type == 'register' ? 'selected' : '' }}>Register</option>
                                        <option value="deposit" {{ $commission->type == 'deposit' ? 'selected' : '' }}>Deposit</option>
                                        <option value="trade" {{ $commission->type == 'trade' ? 'selected' : '' }}>Trade</option>
                                    
                                        </select>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
								</div>
							</div> 
						</div> --}}

                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Reward Type</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="reward_type" class="form-control" >
                                        <option value="percentage" {{ $commission->reward_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="fixed" {{ $commission->reward_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                         
                                        </select>
                                        @if ($errors->has('reward_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('reward_type') }}</strong>
                                            </span>
                                        @endif
								</div>
							</div> 
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Description</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<textarea name="referral_description" class="form-control" value="" required>{{$commission->referral_description}}</textarea>
                                        @if ($errors->has('referral_description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('referral_description') }}</strong>
                                            </span>
                                        @endif
								</div>
							</div> 
						</div>

                        {{-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Title</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="title" class="form-control" value="{{ $commission->title != NULL ? $commission->title : "" }}"/><i class="form-group__bar"></i>
									@if ($errors->has('title'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('title') }}</strong>
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