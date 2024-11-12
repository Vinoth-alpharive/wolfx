@php
$atitle ="cms";
@endphp
@extends('layouts.header')
@section('title', 'Update CMS')
@section('content')
<section class="content">
  <header class="content__title">
    <h1>Update CMS</h1>
  </header>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <!--  <a href="{{ url('admin/cmscontentedit/security') }}"><i class="zmdi zmdi-arrow-left"></i> Back </a> -->
            <br /><br />
          @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                    @if(session('statuserror'))
                        <div class="alert alert-danger  " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('statuserror') }}
                        </div>
                    @endif
  
          <form method="post" action="{{ url('admin/cmscontentupdate') }}" autocomplete="off" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $Data->key}}" name="key">


            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label> Title</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="title" class="form-control" value="{{ $Data->title != NULL ? $Data->title : ' - ' }}" /><i class="form-group__bar"></i>
              @if ($errors->has('title'))
                  <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
                  </span>
                  @endif
                 
                </div>
               
              </div>
            </div>


             <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label> Description</label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea rows="4" cols="50" name="description" class="form-control ckeditor">{{ $Data->description != NULL ? $Data->description : ' - ' }}</textarea>
                @if ($errors->has('description'))
                  <span class="help-block">
                  <strong>{{ $errors->first('description') }}</strong>
                  </span>
                  @endif
                  
                </div>
              
              </div>
            </div>       

            <div class="form-group">
            @if(in_array("write", explode(',',$AdminProfiledetails->cms_settings)))
              <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection