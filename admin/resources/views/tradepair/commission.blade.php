@php
    $atitle = 'coinlist';
@endphp
@extends('layouts.header')
@section('title', 'Coins Setting')
@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Token List Settings</h1>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <a href="{{ url('/admin/addcoin') }}" class="btn btn-info">Add Token</a>
                                <br /><br />
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button><strong>Success!</strong>
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Token Symbol</th>
                                            <th>Token Type</th>
                                            <th>Token Name</th>
                                            <th>Withdraw Commssion</th>
                                            <th>Contract Address</th>
                                            <th>Decimal</th>
                                            <th>Visiblity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                            $limit = 15;
                                            if (isset($_GET['page'])) {
                                                $page = $_GET['page'];
                                                $i = $limit * $page - $limit + 1;
                                            } else {
                                                $i = 1;
                                            }
                                        @endphp
                                        @forelse($commissions as $key => $commission)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $commission->source }}</td>
                                                <td>{{ ucfirst($commission->type) }}</td>
                                                <td>{{ $commission->coinname }}</td>
                                                <td>{{ $commission->withdraw }}</td>
                                                <td>{{ $commission->contractaddress }}</td>
                                                <td>{{ $commission->decimal_value }}</td>
                                                <td>{{ $commission->shown == 1 ? 'Show' : 'Hide' }}</td>
                                                <td>{{ $commission->shown == 1 ? 'Active' : 'Inactive' }}</td>
                                                @if(in_array("write", explode(',',$AdminProfiledetails->coinsetting)))
                                                <td><a href="{{ url('/admin/coinsettings', Crypt::encrypt($commission->id)) }}"
                                                        class="btn btn-info">View / Edit</a></td>
                                                @endif
                                                @if(in_array("delete", explode(',',$AdminProfiledetails->coinsetting)))
                                                <td><a href="{{ url('/admin/deletedcoin', Crypt::encrypt($commission->id)) }}"
                                                        class="btn btn-info">Delete</a></td>
                                                @endif
                                                @php
                                                    $i++;
                                                @endphp
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"> {{ 'No List Settings' }}!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $commissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
