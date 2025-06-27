@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid mb-2">
		<div class="row">
			<div class="col-sm-6">
				@auth
				<h1 class="m-0 text-dark">Welcome, {{ Auth::user()->name }}</h1>
				@else
				<h1 class="m-0 text-dark">Welcome, Guest</h1>
				@endauth
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		@auth
		<div class="text-secondary font-italic text-capitalize text-lg">
			{{ Auth::user()->role }}
		</div>
		@endauth
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<!-- <div class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header d-flex row">
			</div>
		</div>
	</div>
</div> -->
<!-- /.content -->
@endsection