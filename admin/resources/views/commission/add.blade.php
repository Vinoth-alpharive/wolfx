@extends('layouts.header')
@section('title', 'Add Token Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Add Token Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/tokenlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Token</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Required!</strong> {{ session('error') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/addtokeninsert') }}" enctype="multipart/form-data"   autocomplete="off">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Source (Symbol)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="symbol" class="form-control" value="{{ old('symbol') }}" ><i class="form-group__bar"></i>
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
									<label>Token Name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="coinname" class="form-control" value="{{ old('coinname') }}"/><i class="form-group__bar"></i>
									@if ($errors->has('coinname'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('coinname') }}</strong>
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
									<input type="number" name="withdraw" class="form-control"  step="0.01" min="0" max="10000000" value="{{ old('withdraw') }}"/><i class="form-group__bar"></i>
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
									<label>Type</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group" {{ $errors->has('type') ? ' has-error' : '' }}>

									<select name="type" id="coin_type" class="form-control" >
										<!-- <option value="">Select type</option> -->
										<!-- <option value="coin" {{ old('type') == 'coin' ? 'selected' : '' }}>Coin</option>
										 <option value="fiat" {{ old('type') == 'fiat' ? 'selected' : '' }}>Currency</option> -->
										<option value="bsctoken" selected>Bep20 Token</option>
										<option value="trxtoken" selected>TRC20 Token</option>
									</select>
									@if ($errors->has('type'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('type') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>

							<div class="row" id="contract" >
							<div class="col-md-3">
								<div class="form-group">
									<label>Contract address</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<textarea  name="contractaddress" class="form-control" value=""/>{{ old('contractaddress') }}</textarea><i class="form-group__bar"></i>
									@if ($errors->has('contractaddress'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('contractaddress') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>

							<div class="row" id="abi">
							<div class="col-md-3">
								<div class="form-group">
									<label>Abi array</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<textarea  name="abiarray" class="form-control" value=""/>{{ old('abiarray') }}</textarea><i class="form-group__bar"></i>
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
									<label>Netfee</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="netfee" step="0.00001" min="0" max="10000000" class="form-control" value="{{ old('netfee') }}"/><i class="form-group__bar"></i>
									@if ($errors->has('netfee'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('netfee') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Point digit</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="digit"  min="0" max="100000" class="form-control" value="{{ old('digit') }}"/><i class="form-group__bar"></i>
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
									<label>Live url(Optional)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="url" class="form-control" value="{{ old('url') }}"/><i class="form-group__bar"></i>
									@if ($errors->has('url'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('url') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Minimum deposit</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="min_deposit"  step="any" min="0" max="100000000000" class="form-control" value="{{ old('min_deposit') }}"/><i class="form-group__bar"></i>
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
									<input type="number" name="min_withdraw"  step="any" min="0" max="100000000000" class="form-control" value="{{ old('min_withdraw') }}"/><i class="form-group__bar"></i>
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
									<label>Is Swap</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group" {{ $errors->has('is_swap') ? ' has-error' : '' }}>

									<select name="is_swap" id="is_swap" class="form-control" >
										<option value="1" selected>Active</option>
										<option value="0" selected>Deactive</option>
									</select>
									@if ($errors->has('is_swap'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('is_swap') }}</strong>
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
										<div class="col-xs-12 inputGroupContainer"> <img id="doc1" width="128px"  height="128px" class="img-responsive kyc_img_cls" />
											<label for="file-upload1" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload Image </label>
											<input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)" name="image" type="file" style="display:none;">
											<label id="file-name1"></label>
											<br/>
											<br/>
											@if ($errors->has('image')) <span class="help-block"> <strong>{{ $errors->first('image') }}</strong> </span><br/> @endif 
											<p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only png,svg image format 128 X 128</p>
										</div>
									</div>							
								</div>
							</div>
						</div>



						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Add Now</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection

