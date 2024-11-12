@php
$atitle ="category";
@endphp
@extends('layouts.header')
@section('title', 'Country Edit')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Country Edit</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/countrieslist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Countries</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/countryupdate') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $Country->id }}" name="id">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Country Code</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="code" class="form-control" value="{{ $Country->code }}"  /><i class="form-group__bar"></i>

									@if ($errors->has('code'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('code') }}</strong>
					                    </span>
					                @endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Country Name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="name" class="form-control" value="{{ $Country->name  }}"  /><i class="form-group__bar"></i>
										@if ($errors->has('name'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('name') }}</strong>
					                    </span>
					                @endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Status</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									
									<input name="status" value="1" type="radio"  @if ($Country->status=="1")  checked @endif>Active
									
									<input name ="status" value="0" type="radio" @if ($Country->status=="0")  checked @endif>Inactive 
								
									@if ($errors->has('status'))
									<span class="help-block">
									<strong>{{ $errors->first('status') }}</strong>
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