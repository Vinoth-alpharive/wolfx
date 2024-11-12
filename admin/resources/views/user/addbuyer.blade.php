@php
$atitle = "buyer";
@endphp

@extends('layouts.header')
@section('title', 'Adding Buyer')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Add buyer</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('admin/buyer') }}"><i class="zmdi zmdi-arrow-left"></i> Back to buyer</a>
                    <br /><br />

                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> {{ session('error') }}
                    </div>
                    @endif

                    <form method="post" action="{{ url('admin/doaddBuyer') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Username</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="username" id="username" class="form-control" value="{{old('username')}}">
                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="password" id="password" class="form-control" value="{{old('password')}}">
                                    <span class="input-group-text" id="passtexticon"
                                                            onClick="getPasswordResponse()"><i
                                                                class="fa fa-eye-slash"></i> </span>
                                    @if ($errors->has('password'))
                                    
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
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
                                    <input type="text" name="price" class="form-control" value="{{ old('price') }}" /><i class="form-group__bar"></i>
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
                                    <label>Role</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{-- <label>Roles:</label> --}}

                                    <!-- Base1 Checkbox -->
                                    @forelse($category as $categ) 
                                    <div class="form-check">
                                        <input type="checkbox" name="role[]" value="{{$categ->name ?? ''}}" class="form-check-input" id="roleBase{{$categ->id ?? ''}}" {{ is_array(old('role')) && in_array($categ->name, old('role')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleBase{{$categ->id ?? ''}}">{{$categ->name ?? ''}}</label>
                                    </div>
                                    @empty
                                    @endforelse
                                    {{-- <div class="form-check">
                                        <input type="checkbox" name="role[]" value="Base1" class="form-check-input" id="roleBase1" {{ is_array(old('role')) && in_array('Base1', old('role')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleBase1">Base1</label>
                                    </div> --}}

                                    <!-- Base2 Checkbox -->
                                    {{-- <div class="form-check">
                                        <input type="checkbox" name="role[]" value="Base2" class="form-check-input" id="roleBase2" {{ is_array(old('role')) && in_array('Base2', old('role')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleBase2">Base2</label>
                                    </div>

                                    <!-- Base3 Checkbox -->
                                    <div class="form-check">
                                        <input type="checkbox" name="role[]" value="Base3" class="form-check-input" id="roleBase3" {{ is_array(old('role')) && in_array('Base3', old('role')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleBase3">Base3</label>
                                    </div> --}}

                                    <!-- Validation error message -->
                                    @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-light"><i class=""></i> Add</button>
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
                    $('#symbolsec').show();
                } else {
                    $('#symbolsec').hide();
                }
            });
        });

        function getPasswordResponse() {
            var password_repsonse = document.getElementById("password");
            if (password_repsonse.getAttribute('type') === "password") {
                password_repsonse.setAttribute('type', 'text');
                document.getElementById("passtexticon").innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
            } else {
                password_repsonse.setAttribute('type', 'password');
                document.getElementById("passtexticon").innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
            }
        }

    </script>
