@php
$atitle ="termsservices";
@endphp
@extends('layouts.header')
@section('title', 'Terms & Services')
@section('content')
<section class="content">
<div class="content__inner">
	<header class="content__title">
		<h1>Update Terms & Services Content</h1>
	</header>
	@if(session('status'))
	    <div class="alert alert-success" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	        </button>
	    {{ session('status') }}
	    </div>
	@endif
	<div class="card">
		<div class="card-body"> 
			<form method="post" autocomplete="off" action="{{ url('admin/save_termsservices') }}">
			    {{ csrf_field() }}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						   <textarea class="ckeditor" name="termsservice"  required="">
						        @if(is_object($terms) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $terms->termsservice) @endphp
                                    {{ $data }}
                                @endif
						   </textarea>
						   @if ($errors->has('termsservice'))
							<span class="help-block">
							<strong>{{ $errors->first('termsservice') }}</strong>
							</span>
							@endif
						</div>


					</div>
				</div>
				<div class="form-group">
					<button type="submit" name="update_content" class="btn btn-light"><i class=""></i> Update Content</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection