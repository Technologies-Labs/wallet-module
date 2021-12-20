@extends('layouts.simple.master')
@section('title', 'Basic DataTables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Wallet</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Wallet</li>
<li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
                     <table class="display" id="basic-1">
                        <thead>
                            @if($message = Session::get('success'))
                            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                                <i data-feather="thumbs-up"></i>
                                <p>{{ $message }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            @endif
                            @can('wallet-create')
                                <div style="margin-bottom:5px ">
                                    <a class="btn btn-success" href="{{ route('wallets.create') }}"> Create wallet</a>
                                </div>
                            @endcan
                            <tr>
                                <th>No          </th>
                                <th>User        </th>
                                <th>Balance     </th>
                                <th>Created at  </th>
                                <th>Updated at  </th>
                                <th>Action      </th>
                            </tr>
                         </thead>
                            <tbody>
                            @foreach ($wallets as $key => $wallet)
                                <tr id="delete_wallets_{{ $wallet->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $wallet->user->name }}</td>
                                    <td>{{ $wallet->balance }}</td>
                                    <td>{{ $wallet->created_at }}</td>
                                    <td>{{ $wallet->updated_at }}</td>
                                    <td class="text-center">
                                        @can('wallet-edit')
                                        <a class="btn btn-primary m-b-5"  href="{{ route('wallets.edit',$wallet->id) }}"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('wallet-delete')
                                           <a href="javascript:void(0);" onclick="delete_item({{ $wallet->id }},'wallets')" class="btn btn-danger m-b-5"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
