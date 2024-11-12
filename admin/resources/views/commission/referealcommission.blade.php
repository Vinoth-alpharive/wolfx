@php
    $atitle = 'referalcommission';
@endphp
@extends('layouts.header')
@section('title', 'Coins Setting')
@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Referal Commission</h1>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                {{-- <a href="{{ url('/admin/addcoin') }}" class="btn btn-info">Add Token</a> --}}
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
                                            <th>Coin</th>
                                            <th>Amount</th>
                                            {{-- <th>Role</th> --}}
                                            {{-- <th>Generation</th> --}}
                                            {{-- <th>Deposit</th> --}}
                                            {{-- <th>Register</th> --}}
                                            {{-- <th>Stake</th> --}}
                                            {{-- <th>Trade</th> --}}
                                            <th>Type</th>
                                            <th>Reward Type</th>
                                            {{-- <th>Title</th> --}}
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
                                        @forelse($commissionReferal as $key => $commission)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ strtoupper($commission->coin) }}</td>
                                                <td>{{ $commission->amount }}</td>
                                                {{-- <td>{{ $commission->role }}</td> --}}
                                                {{-- <td>{{ $commission->generation }}</td> --}}
                                                {{-- <td>{{ $commission->deposit }}</td> --}}
                                                {{-- <td>{{ $commission->register }}</td> --}}
                                                {{-- <td>{{ $commission->stake }}</td> --}}
                                                {{-- <td>{{ $commission->trade }}</td> --}}
                                                <td>{{ Ucwords($commission->type) }}</td>
                                                <td>{{ Ucwords($commission->reward_type) }}</td>
                                                {{-- <td>{{ $commission->title }}</td> --}}
                                                <td><a href="{{ url('/admin/referalcommissionedit', Crypt::encrypt($commission->id)) }}"
                                                        class="btn btn-info">View / Edit</a></td>
                                               
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
                                {{ $commissionReferal->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
