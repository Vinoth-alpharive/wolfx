@extends('layouts.header')
@section('title', 'Add Country')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Add Category</h1>
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
                    @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failed!</strong> {{ session('error') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/storecountry') }}" autocomplete="off">
						{{ csrf_field() }}
			
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Country Code</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="code" class="form-control" value=""/><i class="form-group__bar"></i>
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
									<input type="text" name="name" class="form-control" value=""/><i class="form-group__bar"></i>
									@if ($errors->has('name'))
									<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
							</div>
						</div>
							

						<div class="form-group">
							<button type="submit" name="add" class="btn btn-light"><i class=""></i> Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection