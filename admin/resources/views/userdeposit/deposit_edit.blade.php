@php
$atitle ="deposit";
@endphp
@extends('layouts.header')
@section('title', 'Deposit History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>View Deposit</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
				    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        {{ session()->get('error') }}
                        </div>
                    @endif
                    
					<a href="{{ url('admin/deposits/'.$deposit->currency) }}"><i class="zmdi zmdi-arrow-left"></i> Back to deposit history</a>
					<br /><br />
					<form method="post" id="currency_form" action="{{ url('admin/fiatdeposit_update') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $deposit->id }}" name="id">

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Transaction id ({{ $deposit->currency }})</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="txid" class="form-control" value="{{ $deposit->txid ? $deposit->txid  : '-'  }}" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Payment name ({{ $deposit->currency }})</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="payment_name" class="form-control" value="{{ $deposit->type ? $deposit->type  : '-'  }}" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Request Amount ({{ $deposit->currency }})</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="amount" class="form-control" value="{{ number_format($deposit->amount, 2, '.', '') }}" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Credit Amount ({{ $deposit->currency }})</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="credit_amount" class="form-control" value="{{ number_format($deposit->credit_amount,2, '.', '') }}"  /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						@if($deposit->currency =="NGN" || $deposit->currency =="INR")
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Uploaded Proof</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<img src="{{ $deposit->proof }}" width="50%" /><i class="form-group__bar"></i><br /><br />
									<a href="{{ $deposit->proof }}" target="_blank">Click to view large</a>
								</div>
							</div>
						</div>
						@elseif($deposit->payment_name != "perfectmoney" && $deposit->currency =="USD")

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Uploaded Proof</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<img src="{{ $deposit->proof }}" width="50%" /><i class="form-group__bar"></i><br /><br />
									<a href="{{ $deposit->proof }}" target="_blank">Click to view large</a>
								</div>
							</div>
						</div>

						@endif
						<div class="row status-block-deposit">
							<div class="col-md-3">
								<div class="form-group">
									<label>Status</label>
								</div>
							</div>
							@if($deposit->status == 0)
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="status">
									    <option value="0">Waiting for approval</option>
										<option value="1">Approved</option>
										<option value="2">Rejected</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
							<p class="text text-info">NOTE : Once you update the status as "Approved / Rejected", you can't update status again!</p>
						</div>
							@else
							<div class="status-block-deposit-options">
							    @if($deposit->status == 1) Approved @endif
							    @if($deposit->status == 2) Rejected @endif
							    @if($deposit->status == 3) Cancelled by user @endif
                             </div>
							@endif
						</div>
						@if($deposit->status == 0)
							<div class="form-group">
								<button type="submit" name="edit" class="btn btn-light" id="btn_update"><i class=""></i> Update</button>
							</div>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection