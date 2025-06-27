@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Registrasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('registrationList')}}">Daftar Event Saya</a></li>
                    <li class="breadcrumb-item active">Edit Registrasi</li>
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
                <form action="{{ route('updateRegistration', ['registration' => $registration->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtName">Nama</label>
                            <input type="text" id="txtName" name="txtName" class="form-control" value="{{ Auth::user()->name }}" disabled required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtUsername">Username</label>
                            <input type="text" class="form-control" id="txtUsername" name="txtUsername" value="{{ Auth::user()->username }}" disabled required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtEvent">Nama Event</label>
                        <input type="text" class="form-control" id="txtEvent" name="txtEvent" value="{{ $event->name }}" disabled required>

                        <div class="mt-4">
                            @if (isset($event->poster_url))
                            <img src="{{ asset('img/event/' . $event->poster_url) }}" width="160" height="240">
                            @else
                            <img src="{{ asset('img/default.jpg') }}" width="160" height="240">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="txtTransaction">Bukti Pembayaran (BCA: 0980385710)</label>
                        </div>
                        <input type="file" class="form-control" id="txtTransaction" name="txtTransaction" accept="image/*">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('registrationList') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->
@endsection