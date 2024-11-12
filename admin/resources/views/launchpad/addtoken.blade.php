@php
    $atitle = 'p2b-launchpad';
@endphp
@extends('layouts.header')
<style>
    body {
        background: #f9e2cc;
        font-family: 'Arial'
    }

    .made-by {
        text-align: center;
        padding-top: 50px;
        color: #896746;
    }

    .file-wrapper {
        width: 150px;
        height: 150px;
        border: 10px solid black;
        position: relative;
        margin-top: 10px;
    }

    .file-wrapper:after {
        content: '+';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: max-content;
        height: max-content;
        display: block;
        max-height: 85px;
        font-size: 70px;
        font-weight: bolder;
        color: black;
    }

    .file-wrapper:before {
        content: 'Allowded only PDF';
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
        bottom: 15px;
        width: max-content;
        height: max-content;
        font-size: 0.85em;
        color: red;
    }

    .file-wrapper:hover:after {
        font-size: 73px;
    }

    .file-wrapper .close-btn {
        display: none;
    }

    input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 99999;
        cursor: pointer;
    }

    .file-set {
        background-size: cover;
        background-repeat: no-repeat;
        color: transparent;
        padding: 10px;
        border-width: 0px;
    }

    .file-set:hover {
        transition: all 0.5s ease-out;
        filter: brightness(110%);
    }

    .file-set:before {
        color: transparent;
    }

    .file-set:after {
        color: transparent;
    }

    .file-set .close-btn {
        position: absolute;
        width: 35px;
        height: 35px;
        display: block;
        background: #000;
        color: #fff;
        top: 0;
        right: 0;
        font-size: 25px;
        text-align: center;
        line-height: 1.5;
        cursor: pointer;
        opacity: 0.8;
    }

    .file-set>input {
        pointer-events: none;
    }
</style>
@section('title', 'Add Launchpad')
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Add Launchpad</h1>
        </header>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('admin/p2b-launchpad') }}"><i class="zmdi zmdi-arrow-left"></i> Back to IEO Launchpad</a>
                        <br /><br />
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button><strong>Success!</strong>
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ url('admin/insertlaunchpad') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Symbol</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="symbol" id="coin_type" class="form-control">
                                            <option value="">Select Coin</option>
                                            @foreach ($coins as $coin)
                                                <option value="{{ $coin->source }}"
                                                    {{ old('symbol') == $coin->source ? 'selected' : '' }}>
                                                    {{ $coin->source }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                        <label>Buy Currency</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="cointwo" id="coin_type" class="form-control">
                                            <option value="">Select Coin</option>
                                            @foreach ($coins as $coin)
                                                <option value="{{ $coin->source }}"
                                                    {{ old('cointwo') == $coin->source ? 'selected' : '' }}>
                                                    {{ $coin->source }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                        <label>Website(Optional)</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="website" class="form-control"
                                            value="{{ old('website') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('website'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Protocal Network</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" {{ $errors->has('protocol_network') ? ' has-error' : '' }}>

                                        <select name="protocol_network" id="coin_type" class="form-control">
                                            <option value="">Select type</option>
                                            <option value="BEP20"
                                                {{ old('protocol_network') == 'BEP20' ? 'selected' : '' }}>BEP20 Token
                                            </option>
                                            <option value="TRC20"
                                                {{ old('protocol_network') == 'TRC20' ? 'selected' : '' }}>TRC20 Token
                                            </option>
                                            <option value="ERC20"
                                                {{ old('protocol_network') == 'ERC20' ? 'selected' : '' }}>ERC20 Token
                                            </option>
                                            <option value="POLY20"
                                                {{ old('protocol_network') == 'POLY20' ? 'selected' : '' }}>POLY20 Token
                                            </option>
                                            <option value="ERC20"
                                                {{ old('protocol_network') == 'ERC20' ? 'selected' : '' }}>ERC20 Token
                                            </option>
                                        </select>
                                        @if ($errors->has('protocol_network'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('protocol_network') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Industry(Optional)</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="industry" class="form-control"
                                            value="{{ old('industry') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('industry'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('industry') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Project Description (optional)</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <textarea name="description" class="form-control" value="">{{ old('description') }}</textarea><i class="form-group__bar"></i>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Supply per session</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="supply_per_session" class="form-control"
                                            value="{{ old('supply_per_session') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('supply_per_session'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('supply_per_session') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Price per token</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="price_in_cointwo" step="any"
                                            class="form-control" value="{{ old('price_in_cointwo') }}" /><i
                                            class="form-group__bar"></i>
                                        @if ($errors->has('price_in_cointwo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price_in_cointwo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Minimum Token purchase</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="min_token_purchase" step="any"
                                            class="form-control" value="{{ old('min_token_purchase') }}" /><i
                                            class="form-group__bar"></i>
                                        @if ($errors->has('min_token_purchase'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('min_token_purchase') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Minimum Other currency purchase</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="min_othercurrency_purchase" 
                                            class="form-control" value="{{ old('min_othercurrency_purchase') }}" /><i
                                            class="form-group__bar"></i>
                                        @if ($errors->has('min_othercurrency_purchase'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('min_othercurrency_purchase') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Stage</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="stage" class="form-control" /><i
                                            class="form-group__bar"></i>
                                        @if ($errors->has('stage'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('stage') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Discount(%)</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" name="discount" class="form-control" step="any"
                                            value="{{ old('discount') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('discount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('discount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ROI(Optional)</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" step="any" name="roi" class="form-control"
                                            value="{{ old('roi') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('roi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('roi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <!-- <div class="loding">Loading...</div> -->
                                    <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                                        <div class="form-group  has-feedback">
                                            <div class="col-xs-12 inputGroupContainer"> <img id="doc1"
                                                    width="128px" height="128px" class="img-responsive kyc_img_cls" />
                                                <label for="file-upload1" class="custom-file-upload"> <i
                                                        class="fa fa-cloud-upload"></i> Upload Logo </label>
                                                <input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)"
                                                    name="logo" type="file" style="display:none;">
                                                <label id="file-name1"></label>
                                                <br />
                                                <br />
                                                @if ($errors->has('logo'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('logo') }}</strong> </span><br />
                                                @endif
                                                <p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only png
                                                    image format 35 X 35</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <!-- <div class="loding">Loading...</div> -->
                                    <div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
                                        <div class="form-group  has-feedback">
                                            <div class="col-xs-12 inputGroupContainer"> <img id="doc2"
                                                    width="128px" height="128px" class="img-responsive kyc_img_cls" />
                                                <label for="file-upload2" class="custom-file-upload"> <i
                                                        class="fa fa-cloud-upload"></i> Upload Banner </label>
                                                <input id="file-upload2" class="kycimg2" onchange="ValidateSize(this)"
                                                    name="banner" type="file" style="display:none;">
                                                <label id="file-name2"></label>
                                                <br />
                                                <br />
                                                @if ($errors->has('banner'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('banner') }}</strong> </span><br />
                                                @endif
                                                <p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only png
                                                    image format 352 X 236</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <!-- <div class="loding">Loading...</div> -->
                                    <div class="form-group{{ $errors->has('whitepaper') ? ' has-error' : '' }}">
                                        <div class="form-group  has-feedback">
                                            <div class="col-xs-12 inputGroupContainer">
                                               
                                                {{-- <input id="file-upload3" class="kycimg2" onchange="ValidateSize(this)"
                                                    name="whitepaper" type="file" style="display:none;"> --}}

                                                <div class="file-wrapper file">
                                                    <input type="file" name="whitepaper" accept="application/pdf" />
                                                    <div class="close-btn pdf">×</div>
                                                </div>
                                                <label for="file-upload3" class=""> <i
                                                    class="fa fa-cloud-upload"></i> Upload whitepaper </label>


                                                <label id="file-name3"></label>
                                                @if ($errors->has('whitepaper'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('whitepaper') }}</strong> </span><br />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <!-- <div class="loding">Loading...</div> -->
                                    <div class="form-group{{ $errors->has('presentation') ? ' has-error' : '' }}">
                                        <div class="form-group  has-feedback">
                                            <div class="col-xs-12 inputGroupContainer">
                                                
                                                {{-- <input id="file-upload4" class="kycimg2" onchange="ValidateSize(this)"
                                                    name="presentation" type="file" style="display:none;"> --}}

                                                    <div class="file-wrapper file">
                                                        <input type="file" name="whitepaper" accept="application/pdf" />
                                                        <div class="close-btn pdf">×</div>
                                                    </div>
                                                    <label for="file-upload4" class=""> <i
                                                        class="fa fa-cloud-upload"></i> Upload presentation </label>

                                                <label id="file-name4"></label>
                                                @if ($errors->has('presentation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('presentation') }}</strong> </span><br />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="datetime-local" name="start_date" class="form-control"
                                            value="{{ old('start_date') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="datetime-local" name="end_date" class="form-control"
                                            value="{{ old('end_date') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('end_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Referral Commission %</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="referral_commission" class="form-control"
                                            value="{{ old('referral_commission') }}" /><i class="form-group__bar"></i>
                                        @if ($errors->has('referral_commission'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('referral_commission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Referral Credit Coin</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="referral_coin_type" id="referral_coin_type" class="form-control">
                                            <option value="">Select Coin</option>
                                            @foreach ($coins as $coin)
                                                <option value="{{ $coin->source }}"
                                                    {{ old('referral_coin_type') == $coin->source ? 'selected' : '' }}>
                                                    {{ $coin->source }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('referral_coin_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('referral_coin_type') }}</strong>
                                            </span>
                                        @endif
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
        <script src="{{ url('public/js/jquery.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                let fileInputs = $('.file-wrapper input[type="file"]');

                fileInputs.each(function() {
                    let fileInput = $(this);
                    let fileWrapper = fileInput.closest('.file-wrapper');

                    fileInput.on('change', function() {
                        readURL(this, fileWrapper); // Change the image or display PDF icon
                    });

                    $('.close-btn', fileWrapper).on('click', function() { // Unset the image or PDF icon
                        fileWrapper.css('background-image', 'unset');
                        fileWrapper.removeClass('file-set');

                        // Replace the file input with a clone
                        let newFileInput = fileInput.val('').clone(true);
                        fileInput.replaceWith(newFileInput);

                        // Update the event handler for the new file input
                        newFileInput.on('change', function() {
                            readURL(this, fileWrapper);
                        });
                    });
                });
            });

            // FILE
            function readURL(input, obj) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        if (input.files[0].type === 'application/pdf') {
                            // Display a PDF icon or image
                            obj.css('background-image', 'url("https://cdn-icons-png.flaticon.com/512/179/179483.png")');
                        } else {
                            // Display the image for other file types
                            obj.css('background-image', 'url(' + e.target.result + ')');
                        }
                        obj.addClass('file-set');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            };
        </script>

    @endsection
