@php
$atitle ="category";
@endphp
@extends('layouts.header')
@section('title', 'Category Edit')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Category Edit</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('admin/category') }}"><i class="zmdi zmdi-arrow-left"></i> Back</a>
                    <br /><br />
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> {{ session('error') }}
                    </div>
                    @endif

                    <form method="post" action="{{ url('admin/editCategory') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $data->id }}" name="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{ $data->name }}" /><i class="form-group__bar"></i>

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
                                    <input type="number" name="price" class="form-control" value="{{ $data->price  }}" /><i class="form-group__bar"></i>
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
                                    <textarea rows="4" cols="50" name="info" class="form-control ckeditor">{{ $data->info != NULL ? $data->info : ' - ' }}</textarea>
                                    
                                    @if ($errors->has('info'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('info') }}</strong>
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

                                    <input name="status" value="1" type="radio" @if ($data->status=="1") checked @endif>Active
                                    <input name="status" value="0" type="radio" @if ($data->status=="0") checked @endif>Inactive

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
