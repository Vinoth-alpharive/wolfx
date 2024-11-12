@php
    $atitle = 'platformadvantage';
@endphp
@extends('layouts.header')
@section('title', 'Feature')
@section('content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Platform Advantage List</h1>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <a href="{{ url('/admin/platformadvantageadd') }}" class="btn btn-info">Add Platform Advantage</a>
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
                                            <th>Title</th>
                                            <th>Key</th>
                                            <th>Description</th>
                                            {{-- <th>Image</th> --}}
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
                                        @forelse($index as $key => $commission)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $commission->title }}</td>
                                                <td>{{ ucfirst($commission->key) }}</td>
                                                <td>{{ trim($commission->description) }}</td>
                                                {{-- <td>{{ $commission->image }}</td> --}}
                                                <td><a href="{{ url('/admin/platformadvantageedit/platform', Crypt::encrypt($commission->id)) }}"
                                                        class="btn btn-info">View / Edit</a></td>
                                                <td><a href="{{ url('/admin/platformdelete', Crypt::encrypt($commission->id)) }}"
                                                        class="btn btn-info">Delete</a></td>
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
                                {{ $index->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
