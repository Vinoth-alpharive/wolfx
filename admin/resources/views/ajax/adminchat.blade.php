@if($chatlist)
@foreach ($chatlist as $row)
@if($row->message!="")
<div class="messages__item">
	<div class="messages__details">
		@if($userlist->profileimg)
		<img  src="{{ Config::get('app.siteurl').'/public/storage/userprofile/'.$userlist->profileimg }}"></img>
		@else
		<img  src="{{ url('images/client-2.png') }}"></img>
		@endif
		<p>{{ $row->message }}</p>                
		<small><i class="zmdi zmdi-time"></i>{{ $row->created_at }}</small>
	</div>
</div>
@endif

@if($row->reply!="")
<div class="messages__item messages__item--right">
	<div class="messages__details">
		<img src="{{ url('images/adminchat.jpg') }}"></img>
		<p>{{ $row->reply }}</p>
		<small><i class="zmdi zmdi-time"></i> {{ $row->created_at }}</small>
	</div>
</div>
@endif
@endforeach 
@endif  