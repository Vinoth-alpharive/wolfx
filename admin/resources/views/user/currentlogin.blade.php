
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Current Login Users</h1>
	</header>
	<div class="card">
		<div class="card-body">


			  @if ($message = Session::get('updated_status'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
            </div>
            @endif

            <!-- 
		    <form action="{{ url('/admin/loginactivity/search') }}" method="post" autocomplete="off">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-3">                
						<input type="text" name="searchitem" id="searchitem" class="form-control" placeholder="Search for Name or Email or Ipaddress" value= "" required>
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-success user_date" value="Search" />
						<a class="btn btn-warning btn-xs" href="{{ url('admin/users/loginhistory') }}"> Reset </a> 
					</div>
				</div>
			</form> -->
			<br/>
			<div class="table-responsive search_result">
				<table class="table keywords" id="dows">
					<thead>
						<tr>
							<th>S.NO </th>
							<th>Logged At</th>
							<th>Member Name</th>
							<th>Member Email</th>
							<th>Ip Address</th>							
							<th>Location</th>							
						</tr>
					</thead>
					<tbody>					    
					    @php 
			            $i =1;

			            $limit=15;

			            if(isset($_GET['page'])){
							$page = $_GET['page'];
							$i = (($limit * $page) - $limit)+1;
						}else{
						  $i =1;
						}        
						@endphp
					@forelse($details as $user)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ date('d-m-Y H:i:s',strtotime($user->updated_at)) }}</td>
							<td>{{ $user->first_name }} {{ $user->last_name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->ipaddr ? $user->ipaddr : '-' }}</td>	
							<td>{{ $user->location ? $user->location : '-' }}</td>	
						</tr>
						 @php
				         $i++;
				         @endphp				
					@empty
					    <tr><td colspan="7"> No record found!</td></tr>
					@endforelse
					</tbody>
				</table>
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                @if($details->count())
				    {{ $details->links() }}
				@endif
                </div>
              </div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(function(){
    $('#searchitem').on('input', function() {
    this.value = this.value.replace(/[^:::0-9a-zA-Z@. ]/g, '') // numbers and decimals only
    .replace(/(\  *)\ /g, '$1') // space can't exist more than once
var s = $("#acc_name").val();
    if(s.substr(0, 1) == ' '){
      var s = $("#acc_name").val('');      
}
});
  });

</script>

@endsection


