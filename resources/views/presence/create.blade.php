@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Presensi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('paymentList', ['eventId' => $registration->event->id])}}">Daftar Peserta</a></li>
                    <li class="breadcrumb-item active">Presensi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-3">
                <form action="{{ route('storePresence', ['registration' => $registration->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="txtCode">QR Code</label>
                        <input type="text" id="txtCode" name="txtCode" class="form-control" placeholder="QR Code" required>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('paymentList', ['eventId' => $registration->event_id]) }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->
@endsection