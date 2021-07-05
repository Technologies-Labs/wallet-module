@extends('layouts.simple.master')
@section('title', 'Basic DataTables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Wallet</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Wallet</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
            <div class="card">
					<div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                       @endif
                       {!! Form::model($wallet, ['method' => 'PATCH','route' => ['wallets.update', $wallet->id]]) !!}
                        <div class="row">
							<div class="col">
                                <div class="mb-3">
                                    <div class="col-form-label">user name</div>
                                    <select class="js-example-disabled-results col-sm-12" name="user_id">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}" @if($wallet->user_id ==$user->id) selected @endif>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
							</div>
						</div>
                        <div class="row">
							<div class="col">
								<div class="mb-3">
									<label for="order"><strong>Balance</strong> </label>
									{!! Form::number('balance', null, array('class' => 'form-control','required')) !!}
								</div>
							</div>
						</div>
					<div class="card-footer">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
                {!! Form::close() !!}
			</div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection






