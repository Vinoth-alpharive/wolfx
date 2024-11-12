@php
$atitle ="tradepair";
@endphp
@extends('layouts.header')
@section('title', 'Tradepair Settings')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Tradepair Settings</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('admin/tradepairlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Tradepair</a>
                    <br /><br />
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                    </div>
                    @endif


                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> {{ session('error') }}
                    </div>
                    @endif
                    <form method="post" action="{{ url('admin/pairupdate') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $pairres->id }}" name="id">


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coinone</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="coinone" class="form-control" value="{{$pairres->coinone}}" readonly>
                                    @if ($errors->has('coinone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('coinone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cointwo</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <input type="text" name="cointwo" class="form-control" value="{{$pairres->cointwo}}" readonly>
                                    @if ($errors->has('cointwo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cointwo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Minimum Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="min_price" class="form-control" value="{{ $pairres->min_price}}"><i class="form-group__bar"></i>
                                    @if ($errors->has('min_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('min_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Maximum Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="max_price" class="form-control" value="{{ $pairres->max_price}}"><i class="form-group__bar"></i>
                                    @if ($errors->has('max_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('max_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Average Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="average_price" class="form-control" value="{{ $pairres->average_price }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('average_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('average_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" id="symbolsec">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Symbol</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="symbol" class="form-control" value="{{ $pairres->symbol }}"><i class="form-group__bar"></i>
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
                                    <label>Status</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $pairres->active == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $pairres->active == '0' ? 'selected' : '' }}>Deactive</option>
                
                                    </select>
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

    <script src="{{ url('public/js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#is_bot').on('change', function() {
                var value = $(this).val();

                if (value == 1) {
                    $('#bot-symbol').show();
                } else {
                    $('#bot-symbol').hide();
                }
            });
        });

    </script>
