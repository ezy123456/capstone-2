@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Event</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Event</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        @auth
        @if (Auth::user()->role == 'panitia')
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="{{ route('createEvent') }}" class="btn btn-primary" role="button">Tambah Event</a>
        </div>
        @endif
        @endauth
        <div class="d-flex flex-wrap justify-content-start" style="gap: 1rem;">
            @foreach($events as $event)
            <div class="card" style="width: 32%; display: flex; flex-direction: row; padding: 10px;">
                <div style="width: 100px; height: auto; flex-shrink: 0;">
                    <img src="{{ asset('img/event/' . $event->poster_url) }}"
                        alt="Cover {{ $event->name }}"
                        style="width: 100%; aspect-ratio: 2/3; object-fit: cover; border-radius: 5px;">
                </div>

                <div class="ml-3 d-flex flex-column justify-content-between w-100">
                    <div>
                        <h5 class="font-weight-bold mb-1">{{ $event->name }}</h5>
                        <p class="mb-0"><i class="fa fa-user-circle mr-2"></i>{{ $event->speaker }}</p>
                        <p class="mb-0"><i class="fa fa-map-pin mr-3"></i>{{ $event->location }}</p>
                        <p class="mb-0">
                            <i class="fa fa-clock-o mr-2"></i>
                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} |
                            {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                        </p>
                        <p class="mb-1"><i class="fa fa-dollar mr-3"></i>Rp {{ number_format($event->registration_fee, 0, ',', '.') }}</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        @auth
                        @if (Auth::user()->role == 'panitia')
                        <a href="{{ route('paymentList', ['eventId' => $event->id]) }}" class="btn btn-primary btn-sm mr-2">List Peserta</a>
                        <a href="{{ route('editEvent', ['event' => $event->id]) }}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" role="button" data-toggle="modal" data-target="#deleteConfirmationModal{{ $event->id }}"><i class="fa fa-trash"></i></a>
                        @elseif (Auth::user()->role == 'member')
                        <a href="{{ route('createRegistration', ['eventId' => $event->id]) }}" class="btn btn-success btn-sm mr-2">Daftar</a>
                        @elseif (Auth::user()->role == 'tim keuangan')
                        <a href="{{ route('paymentList', ['eventId' => $event->id]) }}" class="btn btn-primary btn-sm mr-2">List Peserta</a>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteConfirmationModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah ingin menghapus event <b>{{ $event->name }}</b>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="{{ route('deleteEvent', ['event' => $event->id]) }}" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection