@php
$atitle ="category";
@endphp
@extends('layouts.header')
@section('title', 'Add category')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Add category</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('admin/category') }}"><i class="zmdi zmdi-arrow-left"></i> Back</a>
                    <br /><br />
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failed!</strong> {{ session('error') }}
                    </div>
                    @endif
                    <form method="post" action="{{ url('admin/addCategory') }}" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="type" value="{{old('type')}}" class="form-control" value="" /><i class="form-group__bar"></i>
                                    @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" /><i class="form-group__bar"></i>
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
                                    <label>Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="price" class="form-control" value="{{old('price')}}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Info</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea rows="4" cols="50" name="info" class="form-control ckeditor">{{ old('info') }}</textarea>

                                    @if ($errors->has('info'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('info') }}</strong>
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
