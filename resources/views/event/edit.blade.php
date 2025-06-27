@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Event</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('eventList')}}">Event</a></li>
                    <li class="breadcrumb-item active">Edit Event</li>
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
                <form action="{{ route('updateEvent', ['event' => $event->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="txtName">Nama</label>
                        <input type="text" id="txtName" name="txtName" class="form-control" required value="{{ $event->name }}">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtLocation">Lokasi</label>
                            <input type="text" class="form-control" id="txtLocation" value="{{ $event->location }}" placeholder="Lokasi Event" name="txtLocation" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtSpeaker">Pembicara</label>
                            <input type="text" class="form-control" id="txtSpeaker" value="{{ $event->speaker }}" placeholder="Nama Pembicara" name="txtSpeaker" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="txtDate">Tanggal</label>
                            <input type="date" class="form-control" id="txtDate" name="txtDate" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="txtTime">Waktu</label>
                            <input type="time" class="form-control" id="txtTime" name="txtTime" value="{{ \Carbon\Carbon::parse($event->time)->format('H:i') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="txtFee">Harga</label>
                            <input type="number" class="form-control" id="txtFee" placeholder="Harga Event" name="txtFee" min="0" max="9999999999" value="{{ $event->registration_fee }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="txtPeserta">Max Peserta</label>
                            <input type="number" class="form-control" id="txtPeserta" name="txtPeserta" placeholder="Max. Peserta" min="0" max="999" value="{{ $event->max_participants }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="coverNow">Poster Sekarang</label>
                        <div>
                            @if (isset($event->poster_url))
                            <img src="{{ asset('img/event/' . $event->poster_url) }}" width="160" height="240">
                            @else
                            <img src="{{ asset('img/default.jpg') }}" width="160" height="240">
                            @endif
                        </div>
                        <div class="mt-2">
                            <label for="txtCover">Pilih Poster</label>
                        </div>
                        <input type="file" class="form-control" id="txtCover" name="txtCover" accept="image/*">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('eventList') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->
@endsection