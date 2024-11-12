@extends('layouts.header')
@section('title', 'Countrieslist - Admin')
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Countries List</h1>
        @if(in_array("write",explode(',',$AdminProfiledetails->countries)))
        <a class="btn btn-success btn-xs" href="{{url ('/admin/addcountryform') }}"> Add</a>
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
                            <th>Country Code</th>
                            <th>Country Name</th>
                            @if(in_array("write", explode(',',$AdminProfiledetails->countries)))
                            <th colspan="1">Action</th>
                            @endif
                            @if(in_array("delete", explode(',',$AdminProfiledetails->countries)))
                            <th colspan="1">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1;
                        $limit=10;
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $i = (($limit * $page) - $limit)+1;
                        }else{
                        $i =1;
                        }
                        @endphp
                        @forelse($Countries as $country)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $country->code}}</td>
                            <td>{{ $country->name }}</td>
                            @if(in_array("write", explode(',',$AdminProfiledetails->countries)))
                            <td><a class="btn btn-success btn-xs" href="{{url ('/admin/countryedit/'.$country->id) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>
                            @endif
                            @if(in_array("delete", explode(',',$AdminProfiledetails->countries)))
                            <td><a class="btn btn-danger btn-xs" href="{{url ('/admin/deletecountry/'.$country->id) }}"><i class="zmdi zmdi-delete"></i> Delete </a> </td>
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
                        @if($Countries->count())
                        {{ $Countries->links() }}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
