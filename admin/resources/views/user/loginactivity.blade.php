
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Users Login History</h1>
	</header>
	<div class="card">
		<div class="card-body">


			  @if ($message = Session::get('updated_status'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
            </div>
            @endif

            
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
			</form>
			<br/>
			<div class="table-responsive search_result">
				<table class="table keywords" id="dows">
					<thead>
						<tr>
							<th>Member Name</th>
							<th>Member Email</th>
							<th>Address</th>
							<th>Ip Address</th>
							<th>Login Date&Time</th>
							<!-- <th>Status</th> -->
						</tr>
					</thead>
					<tbody>		
					@forelse($details as $user)
						<tr>
							<td>{{ user($user->user_id)->first_name }} {{ user($user->user_id)->last_name }}</td>
							<td>{{ user($user->user_id)->email }}</td>
							<td>{{ ($user->location)?$user->location:'-' }}</td>	
							<td>{{ $user->login_ip }}</td>	
							
							<td>{{ date('d-m-Y H:i:s', strtotime($user->created_at)) }}</td>
							<!-- <td>
							@if($user->status==1)
							Logged
							@else
							Logged Out
							@endif
							</td>	 -->						
						</tr>
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


