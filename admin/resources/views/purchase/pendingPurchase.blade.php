@php
$atitle ="pendingpurchase";
@endphp
@extends('layouts.header')
@section('title', ' Pending Purchase')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Cancelled purchase History</h1>
    </header>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div id="buyo" class="tab-pane fade in active show">
                    <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                        @if(session('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ session('success') }}</strong>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-warning alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ session('error') }}</strong>
                        </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>Value</th>
                                    <th>Quantity</th>
                                    <th>Remark</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    {{-- @if(in_array("write", explode(',',$AdminProfiledetails->purchase))) --}}
                                    <th>View</th>
                                    {{-- @endif --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i =1;
                                $limit=30;
                                if(isset($_GET['page'])){
                                $page = $_GET['page'];
                                $i = (($limit * $page) - $limit)+1;
                                }else{
                                $i =1;
                                }
                                @endphp
                                @forelse($purchase as $trade)

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$trade->buyername}}</td>
                                    <td>{{$trade->sellername}}</td>
                                    <td>{{$trade->value}}</td>
                                    <td>{{$trade->qty}}</td>
                                    <td>{{$trade->remark}}</td>
                                    <td>{{$trade->account_name}}</td>
                                    <td>{{$trade->account_number}}</td>
                                    <td><a href="{{url('admin/viewPendingpurchase',Crypt::encrypt($trade->id))}}"><button type="button" class="btn btn-success user_date"><i class="zmdi zmdi-edit"></i>&nbsp View</button></a></td>
                                    {{-- @if(in_array("write", explode(',',$AdminProfiledetails->purchase)))


                                    <form action="{{ url('admin/completePurchase') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $trade['id'] }}">
                                        <td><button type="submit" class="btn btn-warning">Complete</button></td>
                                    </form>
                                    @endif --}}

                                </tr>
                                @php
                                $i++;
                                @endphp
                                @empty
                                <tr>
                                    <td colspan="12">
                                        <div class="alert alert-info">Yet no record available</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="pagination-tt clearfix">
                            @if($purchase->count())
                            {{ $purchase->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    <script>
        function pageredirect(self) {
            window.location.href = self.value;
        }

    </script>
