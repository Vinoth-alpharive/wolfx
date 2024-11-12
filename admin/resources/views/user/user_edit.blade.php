@php
if($userdetails->user_type == 'Buyer') {
$atitle = "buyer";
} else {
$atitle = "seller";
}
@endphp

@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>View User Details</h1>
    </header>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    @if($userdetails->user_type == 'Buyer')
                    <a href="{{ url('admin/buyer') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    @else
                    <a href="{{ url('admin/seller') }}"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    @endif

                    <br /><br />

                    @if (session('updated_status'))
                    <div class="alert alert-success">
                        {{ session('updated_status') }}
                    </div>
                    @endif


                    @if (session('updated_error'))
                    <div class="alert alert-danger">
                        {{ session('updated_error') }}
                    </div>
                    @endif

                    <div class="tab-container">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/admin/users_edit/' . Crypt::encrypt($userdetails->id)) }}" role="tab">User Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/transactionall/' . Crypt::encrypt($userdetails->id) . '/BTC') }}" role="tab">Transactions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/users_referral/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Referral</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/users_wallet/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Wallet</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/userdeposit/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Deposit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/user_withdraw/' . Crypt::encrypt($userdetails->id)) }}" role="tab">Coin Withdraw</a>
                            </li>


                        </ul>

                        </br>
                    </div>


                    <form method="post" action="{{ url('admin/update_user') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $userdetails->id }}" name="id">

                        {{-- <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email ID</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" value="{{ $userdetails->email }}" /><i class="form-group__bar"></i>
                                </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong class="text text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="price" class="form-control" value="{{ $userdetails->price ?? '-' }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong class="text text-danger">{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="country">
                                        @if ($userdetails->country == '')
                                        <option value="">Select Country</option>
                                        @foreach (country() as $countrys)
                                        <option value="{{ $countrys->id }}" @if ($countrys->id == $userdetails->country) selected @endif>
                                            {{ $countrys->name }}</option>
                                        @endforeach
                                        @else
                                        @foreach (country() as $countrys)
                                        <option value="{{ $countrys->id }}" @if ($countrys->id == $userdetails->country) selected @endif>
                                            {{ $countrys->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong class="text text-danger">{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone No</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="phone" class="form-control" value="{{ $phone }}" /><i class="form-group__bar"></i>
                                    @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong class="text text-danger">{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Address</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" cols="10" name="address">{{ $address }}</textarea>
                                    @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong class="text text-danger">{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nationality</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="nationality" class="form-control" value="{{ $userdetails->nationality ? $userdetails->nationality : '-' }}" /><i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Refferal ID</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="referral_id" class="form-control" value="{{ $userdetails->referral_id }}" readonly /><i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Parent ID</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="parent_id" class="form-control" value="{{ $userdetails->parent_id ? $userdetails->parent_id : '-' }}" /><i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email Verify</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">

                                        @if ($userdetails->email_verify == 1)
                                        <select name="emailcheck" class="form-control" required>
                                            <option value="1">Verified</option>
                                            <option value="0">Not Verify</option>
                                        </select>
                                        @else
                                        <select name="emailcheck" class="form-control" required>
                                            <option value="0">Not Verify</option>
                                            <option value="1">Verified</option>
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="toggle-switch">

                                        <input type="checkbox" class="toggle-switch__checkbox" name="is_payment" @if ($userdetails->is_payment == 1) checked="" @endif value="1">
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>2FA Access</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">

                                        <select name="twofactor" class="form-control">
                                            <option value="">Please select</option>
                                            <option value="0">Reset 2FA</option>
                                            <option value="1" @if ($userdetails->twofa == 'email_otp') selected @endif>
                                                Email OTP</option>
                                            <option value="3" @if ($userdetails->twofa == 'google_otp') selected @endif>
                                                Google Authenticator</option>
                                            <option value="2">Reset Google 2fa secret</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> User block</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="toggle-switch">

                                        <input type="checkbox" class="toggle-switch__checkbox" name="user_status" @if ($userdetails->status == 1) checked="" @endif value="1">
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> User block reason</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <textarea rows="4" name="reason_block" class="form-control">{{ $userdetails->reason }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Role</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                    @forelse($category as $categ) 
                                        <div class="form-check">
                                            <input type="checkbox" name="user_role[]" value="{{$categ->name ?? ''}}" class="form-check-input" id="roleBase{{$categ->id ?? ''}}" {{ is_array($userrole) && in_array($categ->name, $userrole) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="roleBase{{$categ->id ?? ''}}">{{$categ->name ?? ''}}</label>
                                        </div>
                                    @empty
                                    @endforelse

                                    {{-- <div class="form-check">
                                        <input type="checkbox" name="user_role[]" value="Base1" class="form-check-input" id="roleBase1" {{ is_array($userrole) && in_array('Base1', $userrole) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleBase1">Base1</label>
                                    </div> --}}
                                    
                                    <!-- Base2 Checkbox -->
                                    {{-- <div class="form-check">
                                        <input type="checkbox" name="user_role[]" value="Base2" class="form-check-input" id="roleBase2" {{ is_array($userrole) && in_array('Base2',$userrole) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleBase2">Base2</label>
                                    </div> --}}

                                    <!-- Base3 Checkbox -->
                                    {{-- <div class="form-check">
                                        <input type="checkbox" name="user_role[]" value="Base3" class="form-check-input" id="roleBase3" {{ is_array($userrole) && in_array('Base3', $userrole) ? 'checked' : '' }}>
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
                            <button type="submit" name="edit" class="btn btn-light"><i class=""></i>
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @if (session('withdraw_status'))
    <div class="alert alert-success">
        {{ session('withdraw_status') }}
    </div>
    @endif

    @if (session('withdraw_error'))
    <div class="alert alert-danger">
        {{ session('withdraw_error') }}
    </div>
    @endif

    @if (count($Bankuser) > 0)
    <div class="card">
        <div class="card-body">
            <h5 class="">BANK DETAILS</h5></br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>S.No</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Bank Name</th>
                        <th>Bank Branch</th>
                        <th>Bank Address</th>
                        <th>Swift Code</th>
                        <th>Branch Code</th>
                    </thead>
                    <tbody>
                        @php $i =1 ;@endphp
                        @foreach ($Bankuser as $bank)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $bank->account_name ? $bank->account_name : '-' }}</td>
                            <td>{{ $bank->account_no ? $bank->account_no : '-' }}</td>
                            <td>{{ $bank->bank_name ? $bank->bank_name : '-' }}</td>
                            <td>{{ $bank->bank_branch ? $bank->bank_branch : '-' }}</td>
                            <td>{{ $bank->bank_address ? $bank->bank_address : '-' }}</td>
                            <td>{{ $bank->swift_code ? $bank->swift_code : '-' }}</td>
                            <td>{{ $bank->branch_code ? $bank->branch_code : '-' }}</td>
                        </tr>
                        @php $i++;@endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    @endsection
