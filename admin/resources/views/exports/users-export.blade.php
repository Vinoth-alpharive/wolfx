@php
$atitle ="users";
@endphp
@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<table class="table" id="dvData" style="display: none;">
	<thead>
		<tr>
			<th>S.NO </th>
			<th>User ID </th>
			<th>Role </th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email ID</th>
			<th>Phone number</th>
			<th>Email Verified</th>
			<th>Nationality</th>
			<th>Date of Birth</th>
			<th>Company Type</th>
			<th>Business Name</th>
			<th>Business Country</th>
			<th>Business Email</th>
			<th>Business First Name</th>
			<th>Business Middle Name</th>
			<th>Business Last Name</th>
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
			<td>{{ $user->id }}</td>
			<td>{{ $user->role }}</td>
			<td>{{ $user->first_name }}</td>
			<td>{{ $user->last_name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->phone_no ? $user->phone_no : '-'  }}</td>
			<td>{{ $user->email_verify == 1 ? 'Yes' : 'No'  }}</td>
			<td>{{ $user->nationality  }}</td>
			<td>{{ $user->dob  }}</td>
			<td>{{ $user->company_type  }}</td>
			<td>{{ $user->business_name  }}</td>
			<td>{{ $user->business_country  }}</td>
			<td>{{ $user->business_email  }}</td>
			<td>{{ $user->business_first_name  }}</td>
			<td>{{ $user->business_middle_name  }}</td>
			<td>{{ $user->business_last_name  }}</td>
		</tr>
		 @php
         $i++;
         @endphp				
	@empty
	    <tr><td colspan="7"> No record found!</td></tr>
	@endforelse
	</tbody>
</table>
@endsection 