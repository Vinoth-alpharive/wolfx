@extends('layouts.header')
@section('title', 'Affiliate Commission Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Affiliate Commission Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/aff_commission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Affiliate Commission</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/aff_commissionupdate') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $AffilateCommission->id }}" name="id">
							<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Generation</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="generation" class="form-control" value="{{ $AffilateCommission->generation != NULL ? $AffilateCommission->generation : '0' }}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin / Token</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="coin_name">
									@foreach($commission as $key => $value)
									<option value="{{ $value->source }}"  @if($value->source == $AffilateCommission->coin ) selected @endif >{{ $value->source }}</option>
									@endforeach
									</select>
									@if ($errors->has('coin_name'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('coin_name') }}</strong>
					                    </span>
					                @endif
								</div>
							</div>
						</div>

<!-- 
					
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>User KYC Verified Commission</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="register" class="form-control"  step="any" min="0" max="10000000" value="{{ $AffilateCommission->register != NULL ? $AffilateCommission->register : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('register'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('register') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div>  -->
						 <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Stake Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="stake"  step="0.01" min="0" max="10000000" class="form-control" value="{{ $AffilateCommission->stake != NULL ? $AffilateCommission->stake : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('stake'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('stake') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div> 
					
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Stake Level</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								<select class="form-control" name="title">
									<option value="level_income"  @if('level_income' == $AffilateCommission->title ) selected @endif >Level income</option>
									<!-- <option value="rank_1"  @if('rank_1' == $AffilateCommission->title ) selected @endif >Rank 1</option>
									<option value="rank_2"  @if('rank_2' == $AffilateCommission->title ) selected @endif >Rank 2</option>
									<option value="rank_3"  @if('rank_3' == $AffilateCommission->title ) selected @endif >Rank 3</option>
									<option value="rank_4"  @if('rank_4' == $AffilateCommission->title ) selected @endif >Rank 4</option> -->
									</select>
									@if ($errors->has('title'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('title') }}</strong>
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