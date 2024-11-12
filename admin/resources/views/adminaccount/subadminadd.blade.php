@php
$atitle ="subadmincontrol";
@endphp
@extends('layouts.header')
@section('title', 'Add sub- Admin')
@section('content')

<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Sub Admin </h1>
    </header>
    <div class="card">
      <div class="card-body customcheck">
        <a href="{{ url('admin/subadminlist') }}"><i class="zmdi zmdi-arrow-left"></i> Back</a>
        <br>
        <p>Sub Admin :-</p>
        <br />
        {{-- @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
      </div>
      @endif --}}

      @if ($error = Session::get('error'))
      <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $error }}</strong>
      </div>
      @endif
      <form method="post" action="{{ url('admin/subadmincreated') }}" autocomplete="off">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ctmcheck {{ $errors->has('username') ? ' has-error' : '' }}">
              <input type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="username" class="form-control" id="username" value="{{ old('username') }}" required />
              <i class="form-group__bar"></i>
            </div>
            @if ($errors->has('username'))
            <span class="help-block" style="color:red;">
              <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ctmcheck">
              <input type="email" name="email" onkeypress="return AvoidSpace(event)" required pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" class="form-control" value="{{ old('email') }}" required />
              <i class="form-group__bar"></i>
            </div>
            @if ($errors->has('email'))
            <span class="help-block" style="color:red;">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ctmcheck {{ $errors->has('password') ? ' has-error' : '' }}">
              <input type="password" name="password" id="password" class="form-control" value required />
              <i class="form-group__bar"></i>
              @if ($errors->has('password'))
              <span class="help-block" style="color:red;">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
              <!-- <small class="form-text text-muted" style="color:red !important;" >
                Password must contain at least one uppercase letter (A-Z), one number (0-9), and one special character (e.g., @).
              </small> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Confirm Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ctmcheck {{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
              <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" value required />
              <i class="form-group__bar"></i>
              @if ($errors->has('confirmpassword'))
              <span class="help-block" style="color:red;">
                <strong>{{ $errors->first('confirmpassword') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>

        {{-- <div class="row">
            <div class="col-md-7"> 
              <div class="form-group">
                Notes :
                Your password must contain at least 8 characters, one uppercase (ex: A, B, C, etc), one lowercase letter, one numeric digit (ex: 1, 2, 3, etc) and one special character (ex: @, #, $, etc).
              </div>
            </div>
          </div> --}}


        <div class="checkmrkbox">

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Dashboard</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="dashboard[]" class="checkmark" value="buyers" />
                  <span class="checkmark">Buyer</span>
                </label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="dashboard[]" class="checkmark" value="sellers" />
                  <span class="checkmark">Seller</span>
                </label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="dashboard[]" class="checkmark" value="coinrequest" />
                  <span class="checkmark">Coin Request</span>
                </label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="dashboard[]" class="checkmark" value="userdetails" />
                  <span class="checkmark">User Details</span>
                </label>
              </div>
            </div>

          </div>
          <div class="row mb-20 mt-20">
            <div class="col-md-3"></div>
            <div class="col-md-3">
              <h5>Read</h5>
            </div>
            <div class="col-md-3">
              <h5>Write</h5>
            </div>
            <div class="col-md-3">
              <h5>Delete</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Users List</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="userlist[]" class="checkmark" value="read" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="userlist[]" class="checkmark" value="write" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                {{-- <label>
                    <input type="checkbox" name="userlist[]" class="checkmark" value="delete"  />
                    <span class="checkmark"></span>
                  </label> --}}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Referral Commision</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="refferalcommission[]" class="checkmark" value="read" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="refferalcommission[]" class="checkmark" value="write" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                {{-- <label>
                    <input type="checkbox" name="refferalcommission[]" class="checkmark" value="delete"  />
                    <span class="checkmark"></span>
                  </label> --}}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Refferal History</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="refferalhistory[]" class="checkmark" value="read" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                {{-- <label>
                    <input type="checkbox" name="refferalhistory[]" class="checkmark" value="write" />
                    <span class="checkmark"></span>
                  </label> --}}
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                {{-- <label>
                    <input type="checkbox" name="refferalhistory[]" class="checkmark" value="delete"  />
                    <span class="checkmark"></span>
                  </label> --}}
              </div>
            </div>
          </div>

          {{-- <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>User Deposit History</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="deposithistory[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="deposithistory[]" class="checkmark" value="write" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  {{-- <label>
                    <input type="checkbox" name="deposithistory[]" class="checkmark" value="delete"  />
                    <span class="checkmark"></span> --}}
          {{-- </label>
                </div>
              </div>
            </div>  --}}

          {{-- <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Admin Wallet</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="adminwallet[]" class="checkmark" value="read" />
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">

                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">

                </div>
              </div>
            </div>  --}}

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Withdraw Wallet</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="withdrawwallet[]" class="checkmark" value="read" />
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">

              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Coin Setting</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="coinsetting[]" class="checkmark" value="read" />
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="coinsetting[]" class="checkmark" value="write" />
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                {{-- <label>
                    <input type="checkbox" name="coinsetting[]" class="checkmark" value="delete" />
                  </label> --}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Contact</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="contact[]" class="checkmark" value="read" />
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                {{-- <label>
                    <input type="checkbox" name="contact[]" class="checkmark" value="write" />
                    <span class="checkmark"></span>
                  </label>            --}}
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="contact[]" class="checkmark" value="delete" />
                  <span class="checkmark"></span>
                </label>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Deposit History</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="depositlist[]" class="checkmark" value="read" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="depositlist[]" class="checkmark" value="write" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Withdraw History</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="withdrawlist[]" class="checkmark" value="read" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="withdrawlist[]" class="checkmark" value="write" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Category</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="category[]" class="checkmark" value="read" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="category[]" class="checkmark" value="write" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">

              </div>
            </div>
          </div>
          {{-- <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Trade History</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="tradehistory[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                <label>
                    <input type="checkbox" name="tradehistory[]" class="checkmark" value="write" />
                    <span class="checkmark"></span>
                  </label>

                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">

                </div>
              </div>
            </div> --}}


          {{-- <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>P2P</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="p2p[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="p2p[]" class="checkmark" value="write" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="p2p[]" class="checkmark" value="delete"  />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div> --}}

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Commission Settings</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="commissionsetting[]" class="checkmark" value="read" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                <label>
                  <input type="checkbox" name="commissionsetting[]" class="checkmark" value="write" />
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">

              </div>
            </div>
          </div>
          {{-- <div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Admin Bank Details</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="adminbank[]" class="checkmark" value="read" />
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="adminbank[]" class="checkmark" value="write" />
</label>
</div>
</div> --}}
          <div class="col-md-3">
            <div class="form-check">
              {{-- <label>
<input type="checkbox" name="adminbank[]" class="checkmark" value="delete" />
</label> --}}
            </div>
          </div>
        </div>


        {{-- <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Countries</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="countries[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="countries[]" class="checkmark" value="write" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="countries[]" class="checkmark" value="delete"  />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div> --}}

        {{-- <div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>KYC</label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="kyc[]" class="checkmark" value="read" />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="kyc[]" class="checkmark" value="write" />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">

    </div>
  </div>
</div> --}}
        <!--<div class="row">-->
        <!--  <div class="col-md-3">-->
        <!--    <div class="form-group">-->
        <!--      <label>Admin Security Settings</label>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="col-md-3">-->
        <!--    <div class="form-check">-->
        <!--      <label>-->
        <!--        <input type="checkbox" name="adminsecurity[]" class="checkmark" value="read" />-->
        <!--      </label>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="col-md-3">-->
        <!--    <div class="form-check">-->
        <!--      <label>-->
        <!--        <input type="checkbox" name="adminsecurity[]" class="checkmark" value="write" />-->
        <!--      </label>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="col-md-3">-->
        <!--    <div class="form-check">-->
        <!--      <label>-->
        <!--        <input type="checkbox" name="adminsecurity[]" class="checkmark" value="delete" />-->
        <!--      </label>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Add Sub Admin</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="addadmin[]" class="checkmark" value="read" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="addadmin[]" class="checkmark" value="write" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="addadmin[]" class="checkmark" value="delete" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Purchase</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="purchase[]" class="checkmark" value="read" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="purchase[]" class="checkmark" value="write" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="purchase[]" class="checkmark" value="delete" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
        </div>

        {{-- <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Subscriber</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="subscriber[]" class="checkmark" value="read" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="subscriber[]" class="checkmark" value="write" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="subscriber[]" class="checkmark" value="delete" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                        </div> --}}



        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>security</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              {{-- <label>
                                <input type="checkbox" name="security[]" class="checkmark" value="read" />
                                <span class="checkmark"></span>
                              </label> --}}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="security[]" class="checkmark" value="write" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              {{-- <label>
                                <input type="checkbox" name="addadmin[]" class="checkmark" value="delete" />
                                <span class="checkmark"></span>
                              </label> --}}
            </div>
          </div>
        </div>

        <!--          <div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Subscriber</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="write"  style=" cursor: not-allowed;" disabled="disabled" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="delete"  style=" cursor: not-allowed;" disabled="disabled"/>
<span class="checkmark"></span>
</label>
</div>
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Contact  </label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="write"  style=" cursor: not-allowed;" disabled="disabled"/>
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="delete" />
<span class="checkmark"></span>
</label>
</div>
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>News </label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="write" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="delete" />
<span class="checkmark"></span>
</label>
</div>
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>post menu </label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="write" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="delete" />
<span class="checkmark"></span>
</label>
</div>
</div>
</div> -->
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label> Support</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="support[]" class="checkmark" value="read" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="support[]" class="checkmark" value="write" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">

            </div>
          </div>
        </div>
        {{-- <div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label> KYC Settings</label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="kyc_settings[]" class="checkmark" value="write" />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">

    </div>
  </div>
</div> --}}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label> Page Content Settings</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="cms[]" class="checkmark" value="read" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <label>
                <input type="checkbox" name="cms[]" class="checkmark" value="write" />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">

            </div>
          </div>
        </div>
    </div>

    @if(in_array("write", explode(',',$AdminProfiledetails->addadmin)))
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <button type="submit" name="edit" class="btn btn-light"><i class></i>Create Subadmin </button>
        </div>
      </div>
    </div>
    @endif
  </div>
  </div>
  </form>
  </div>
  </div>
  </div>

  @endsection