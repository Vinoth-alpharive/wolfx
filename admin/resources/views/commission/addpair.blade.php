@extends('layouts.header')
@section('title', 'Add Coin pair Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Add Coin pair Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/tradepairlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Coinpair</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif


                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif


					<form method="post" action="{{ url('admin/addpairinsert') }}" autocomplete="off">
						{{ csrf_field() }}
				
					

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coinone</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="coinone" class="form-control" >
									<option value="">Select coin/currency</option>
									@foreach($pairres as $value )
										<option value="{{ $value->source }}">{{ $value->source }}</option>
									@endforeach
									</select>
									@if ($errors->has('coinone'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('coinone') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Cointwo</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">

									<select name="cointwo" class="form-control" >
										<option value="">Select coin/currency</option>
										@foreach($pairres as $value )
										<option value="{{ $value->source }}">{{ $value->source }}</option>
									@endforeach
									</select>
									@if ($errors->has('cointwo'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('cointwo') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Minimum Buy Price</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="min_buy_price" class="form-control"  value=""/><i class="form-group__bar"></i>
									@if ($errors->has('min_buy_price'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('min_buy_price') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Minimum Buy Amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="min_buy_amount" class="form-control"  value=""/><i class="form-group__bar"></i>
									@if ($errors->has('min_buy_amount'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('min_buy_amount') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div> 
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Minimum SELL Price</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="min_sell_price" class="form-control"  value=""/><i class="form-group__bar"></i>
									@if ($errors->has('min_sell_price'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('min_sell_price') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Minimum SELL Amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="min_sell_amount" class="form-control"  value=""/><i class="form-group__bar"></i>
									@if ($errors->has('min_sell_amount'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('min_sell_amount') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div> 

							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Wallet Redirect Url</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="walletpair" class="form-control" placeholder="example: BTC_USDT" value=""/><i class="form-group__bar"></i>
									@if ($errors->has('walletpair'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('walletpair') }}</strong>
					                    </span>
					                @endif
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
									<select name="status" class="form-control" >
									<option value="1" >Active</option>
									<option value="0">Deactive</option>
								
									</select>
									@if ($errors->has('status'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('status') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade Rules</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">

						   <textarea class="ckeditor" name="rules" >  </textarea>

									@if ($errors->has('rules'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('rules') }}</strong>
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