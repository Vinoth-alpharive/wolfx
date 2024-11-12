@php
$atitle ="p2ptrade";
@endphp
@extends('layouts.header')
@section('title', 'P2p Raise dis - Admin')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Raise Dispute Query</h1>
    </header>
            <a href="{{ url('admin/pendinghistory') }}">Back</a>

    <div class="card">
      <div class="card-body">
        {{-- @if ($message = Session::get('success'))
    <div class="alert alert-info">{{ $message }} </div><br />
  @endif --}}

  @if(session('status'))
          <div class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
          </div>
        @endif	

        <form method="POST" action="{{ url('admin\p2ptradeupdate') }}">
        {{ csrf_field() }} 
        <input type="hidden" name="id" value="{{ $trades->id }}">
        <div class="row">
              <div class="col-md-6">
                <table class="table">
                  @if($trades->trade_type == 'Buy')
                   <tr>
                       <td colspan="2"><h3 class="title-header white">Buyer Info:-</h3></td>
                    </tr>
                  @else
                  <tr>
                       <td colspan="2"><h3 class="title-header white">Seller Info:-</h3></td>
                    </tr>
                  @endif
                    <tr>
                       <td>Name : </td>
                       <td>{{ $trades->user['first_name'] }} {{ $trades->user['last_name'] }}</td>
                    </tr>
                    <tr>
                       <td>Email : </td>
                       <td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($trades->user['id'])) }} " target="_blank">{{ $trades->user['email'] }}</a></td>
                    </tr>
                    
                 
                  <tr>
                       <td colspan="2"><h3 class="title-header white">Order details:-</h3></td>
                    </tr>
                    <tr>
                       <td>Type : </td>
                       <td>{{ $trades->trade_type }}</td>
                    </tr>
                    
                    <tr>
                       <td>Pair : </td>
                       <td>{{ $trades->pair_get['coinone'] }} / {{ $trades->pair_get['cointwo'] }}</td>
                    </tr>
                    <tr>
                       <td>Purchase price : </td>
                       <td>{{ $trades->price }} {{ $trades->pair_get['cointwo'] }}</td>
                    </tr>
                    <tr>
                       <td>Purchase Amount : </td>
                       <td> {{$trades->volume}} {{ $trades->pair_get['coinone'] }}</td>
                    </tr>
                    <tr>
                       <td>Payment Type : </td>
                       <td> {{ $trades->paymenttype }} </td>
                    </tr>
                    
                    <tr>
                       <td>Status : </td>
                       <td>{{ $trades->status_text }}  </td>
                    </tr>
                    
                    <tr>
                       <td>Remarks : </td>
                       <td>{{ $trades->remarks }}  </td>
                    </tr>
                  </tbody>
                </table>
                <div class="form-group">
                   <label>Uploaded Proof</label>
                   <div class="input-group">
                      <a href="{{ $trades->slipupload }}" target="_blank"><img src="{{ $trades->slipupload }}" style="width: 200px;">  </a>                                  
                   </div>
                </div>
              </div>
              <div class="col-md-6">
                <table  class="table table-borderless">
                  @if($trades->ouid != '')
                  @if($trades->trade_type == 'Buy')
                   <tr>
                       <td colspan="2"><h3 class="title-header white">Seller Info:-</h3></td>
                    </tr>
                  @else
                  <tr>
                       <td colspan="2"><h3 class="title-header white"> Buyer Info:-</h3></td>
                    </tr>
                  @endif
                  <tr>
                       <td>Name : </td>
                       <td>{{ $trades->tradeuser['first_name'] }} {{ $trades->tradeuser['last_name'] }}</td>
                    </tr>
                    <tr>
                       <td>Email : </td>
                       <td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($trades->tradeuser['id'])) }} " target="_blank">{{ $trades->tradeuser['email'] }}</a></td>
                    </tr>
                  @endif
                    <tr>
                       <td colspan="2"><h3 class="title-header white">Seller Bank details:-</h3></td>
                    </tr>
                    <tr>
                       <td>Account Holder Name : </td>
                       <td>{{$trades->account_name}} </td>
                    </tr>
                    <tr>
                       <td>IBAN/Account Number : </td>
                       <td> {{$trades->account_no}} </td>
                    </tr>
                    <tr>
                       <td>Bank Account Information : </td>
                       <td> {{$trades->bank_name}} </td>
                    </tr>
                    
                    <tr>
                       <td>BIC/SORT Code : </td>
                       <td>{{$trades->swift_code}}  </td>
                    </tr>
                    @if($trades->paypal_id !="")
                    <tr>
                       <td colspan="2"><h3 class="title-header white">Seller Paypal details:-</h3></td>
                    </tr>
                    <tr>
                       <td>Paypal ID : </td>
                       <td>{{ $trades->paypal_id }} </td>
                    </tr>

                   @endif
                    
                 </table>
                 
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Remark</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <textarea name="remarks" class="form-control" style="line-height: 30px;" rows=2>
                  </textarea>
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Action</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select class="form-control" name="status" required> 
                     <option value="">Select option</option>                      
                        <option {{ $trades->status == 100 ? 'selected' : '' }} value="100">Release Fund</option>
                        <option {{ $trades->status == 7 ? 'selected' : '' }} value="7">Cancel</option>
                     </select> 
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <div class="col-md-4">
               <button class="btn btn-md btn-warning" type="submit"> Update</button><br /><br />
            </div>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection