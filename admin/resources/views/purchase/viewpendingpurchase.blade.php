@php
$atitle ="pendingpurchase";
@endphp
@extends('layouts.header')
@section('title', 'P2p Raise dis - Admin')
@section('content')
<section class="content purcase-full">
    <div class="content__inner">
        <header class="content__title">
            <h1></h1>
        </header>
        <a href="{{ url('admin/pendingpurchase') }}"><i class="zmdi zmdi-arrow-left"></i> Back</a>

        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-info">{{ $message }} </div><br />
                @endif
                <form method="POST" action="{{ url('admin/completePurchase') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $trades->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Buyer Info:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name : </td>
                                    <td>{{ $trades->buyername }}</td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Order details:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity : </td>
                                    @if($trades->buyerid != "")
                                    <td>{{ $trades->qty }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <td>Value : </td>
                                    @if($trades->buyerid != "")
                                    <td>{{ $trades->value }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Remarks:-</h3>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Buyer Remark : </td>
                                    @if($trades->buyerid != "")
                                    <td>{{ $trades->buyer_remark }}</td>
                                    @endif
                                </tr>

                                </tbody>
                            </table>

                            <div class="form-group">
                                <label>Uploaded Proof</label>
                                @if($trades->buyerid != "")
                                @if(count($photoSlips) > 0)
                                @forelse($photoSlips as $photos)
                                <div class="input-group row">
                                    <div class="input-group col">
                                    <img src="{{ ' https://vipchengdui.com/buyerimg/'.$photos->slip_name ?? '' }}" style="width: 200px;">
                                    </div>
                                </div>
                                @empty
                                @endforelse
                                @endif
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Seller Info:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name : </td>
                                    <td>{{ $trades->sellername }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Order details:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity : </td>
                                    @if($trades->sellerid != "")
                                    <td>{{ $trades->qty }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Value : </td>
                                    @if($trades->sellerid != "")
                                    <td>{{ $trades->value }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Remarks:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Seller Remark : </td>
                                    @if($trades->sellerid != "")
                                    <td>{{ $trades->seller_remark }}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>

                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Release Fund</option>
                                <option value="2">Cancel</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
					        @endif
                        </div>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection
