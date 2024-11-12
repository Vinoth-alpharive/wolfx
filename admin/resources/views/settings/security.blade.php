@php
$atitle ="settings";
@endphp
@extends('layouts.header')
@section('title', 'Support Ticket')
@section('content')
<section class="content">
<div class="content__inner">
  <header class="content__title">
    <h1>SECURITY SETTING</h1>
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
  <form method="post" action="{{ url('admin/changeusername') }}" autocomplete="off">
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Admin Email</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="email" required="required"  id="email" class="form-control" value="{{ $adminemail }}">
              <i class="form-group__bar"></i> </div>

                          @if ($errors->has('email'))
                          <span class="help-block">
                            <strong class="text text-danger">{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                          
          </div>
        </div>
    
        <div class="form-group">
          <button type="submit" name="save" class="btn btn-light"><i class=""></i> Save</button>
        </div>
      </form> 
      @if(session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            {{ session('success') }}
            </div>
      @endif
      @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            {{ session('error') }}
            </div>
      @endif
      <form method="post" action="{{ url('admin/changepassword') }}" autocomplete="off">
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Current Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="password" name="currentpassword" required="required" placeholder="Old Password" id="site_title" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>New Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="password" name="password" required="required" placeholder="New Password" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Confirm New Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group"> <span id="amount"></span>
              <input type="password" name="password_confirmation" required="required"  class="form-control" placeholder="Confirm Password" 
								value="" >
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <input type="hidden" name="token" class="form-control" value="" placeholder="">
        <div class="form-group">
          <button type="submit" name="change_password" class="btn btn-light"><i class=""></i> Change Password</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
@endsection