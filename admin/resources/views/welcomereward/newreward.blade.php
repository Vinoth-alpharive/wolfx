@php
    $atitle = 'welcomerewards';
@endphp
@extends('layouts.header')
@section('title', 'Add welcome reward')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Add Welcome Reward</h1>
        </header>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('admin/welcomereward') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Welcome Rewards</a>
                        <br /><br />
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button><strong>Success!</strong>
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ url('admin/addwelcomereward') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                                                     
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Title</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                           
                            <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Description</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <textarea name="description" class="form-control" value="" >{{ old('description') }}</textarea><i class="form-group__bar"></i>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
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
                                            <div class="col-xs-12 inputGroupContainer"> <img id="doc1"
                                                    width="128px" height="128px" class="img-responsive kyc_img_cls" />
                                                <label for="file-upload1" class="custom-file-upload"> <i
                                                        class="fa fa-cloud-upload"></i> Upload Image </label>
                                                <input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)"
                                                    name="image" type="file" style="display:none;">
                                                <label id="file-name1"></label>
                                                <br />
                                                <br />
                                                @if ($errors->has('image'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('image') }}</strong> </span><br />
                                                @endif
                                                <p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only png,jpg
                                                    image format</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Add
                                    Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
