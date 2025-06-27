@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Event Saya</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Event Saya</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-start" style="gap: 1rem;">
            @foreach($registrations as $registration)
            @php $event = $registration->event; @endphp
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
                        @if ($registration->payment_status == 'pending')
                        <a href="{{ route('editRegistration', ['registration' => $registration->id]) }}" class="btn btn-warning btn-sm d-flex align-items-center mr-2">Edit Payment</a>
                        @else
                        @if ($registration->presence)
                        <span class="badge badge-success d-flex align-items-center mr-2">Attend</span>
                        @else
                        <a href="#" class="btn btn-primary btn-sm d-flex align-items-center mr-2"
                            role="button" data-toggle="modal" data-target="#qrCodeModal{{ $registration->id }}">
                            QR Code
                        </a>
                        @endif

                        @if ($registration->certificate)
                        <a href="{{ asset('img/certificate/' . $registration->certificate->certificate_url) }}"
                            class="btn btn-primary btn-sm d-flex align-items-center"
                            target="_blank"
                            download>
                            <i class="ti-import mr-2"></i>
                            Certificate
                        </a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal QR Code -->
            <div class="modal fade" id="qrCodeModal{{ $registration->id }}" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel{{ $registration->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrCodeModalLabel{{ $registration->id }}">QR Code {{ $event->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Scan QR Code di bawah ini untuk validasi kehadiran:</p>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ route('scanPresence', ['qr_code' => $registration->qr_code]) }}&size=200x200" alt="QR Code">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- /.content -->
@endsection