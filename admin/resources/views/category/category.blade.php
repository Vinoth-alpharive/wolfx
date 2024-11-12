@php
$atitle ="category";
@endphp
@extends('layouts.header')
@section('title', 'Category - Admin')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Category</h1>
        @if(in_array("write",explode(',',$AdminProfiledetails->category)))
        <a class="btn btn-success btn-xs" href="{{url ('/admin/addcategory') }}"> Add</a>
        @endif
        @if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
        </div>
        @endif
    </header>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive search_result">
                <table class="table" id="dows">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            @if(in_array("edit", explode(',',$AdminProfiledetails->category)))
                            <th colspan="1">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1;
                        $limit=5;
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $i = (($limit * $page) - $limit)+1;
                        }else{
                        $i =1;
                        }
                        @endphp
                        @forelse($data as $cat)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->type}}</td>
                            <td>{{ $cat->price }}</td>
                            @if(in_array("write", explode(',',$AdminProfiledetails->category)))
                            <td><a class="btn btn-danger btn-xs" href="{{url ('/admin/editcategory/'.encrypt($cat->id)) }}"> Edit </a> </td>
                            @endif
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @empty
                        <tr>
                            <td colspan="7"> No record found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    <div class="pagination-tt clearfix">
                        @if($data->count())
                        {{ $data->links() }}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
