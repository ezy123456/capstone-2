@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Peserta</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('eventList')}}">Daftar Event</a></li>
                    <li class="breadcrumb-item active">Daftar Peserta</li>
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
            <div class="card-body p-0">
                <table class="table table-hover mb-0 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            @if (Auth::user()->role == 'tim keuangan')
                            <th>Status Pembayaran</th>
                            <th>Tanggal Registrasi</th>
                            @else
                            <th>Status Presensi</th>
                            @endif
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $index => $registration)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $registration->user->name }}</td>
                            <td>{{ $registration->user->username }}</td>
                            @if (Auth::user()->role == 'tim keuangan')
                            <td class="text-capitalize">
                                <span class="badge badge-{{ $registration->payment_status == 'paid' ? 'success' : 'warning' }}">
                                    {{ $registration->payment_status }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($registration->created_at)->format('d M Y H:i') }}</td>
                            <td>
                                <a href="#" class="btn btn-primary mr-2" role="button" data-toggle="modal" data-target="#paymentModal{{ $registration->id }}">Lihat Pembayaran</a>
                                <a href="{{ route('updatePayment', ['registration' => $registration->id]) }}" class="btn btn-success" role="button">Verifikasi</a>
                            </td>
                            @else
                            <td class="text-capitalize">
                                @if ($registration->presence)
                                <span class="badge badge-success">Hadir</span>
                                @else
                                <span class="badge badge-danger">Tidak Hadir</span>
                                @endif
                            </td>
                            <td>
                                @if (!$registration->presence)
                                <a href="{{ route('createPresence', ['registration' => $registration->id]) }}" class="btn btn-primary mr-2">Presensi</a>
                                @else
                                @if ($registration->certificate)
                                <a href="#" class="btn btn-primary mr-2" role="button" data-toggle="modal" data-target="#certificateModal{{ $registration->id }}">Lihat Sertifikat</a>
                                <a href="{{ route('editCertificate', ['certificate' => $registration->certificate->id]) }}" class="btn btn-warning" role="button"><i class="fa fa-edit mr-2"></i>Sertifikat</a>
                                @else
                                <a href="{{ route('createCertificate', ['registration' => $registration->id]) }}" class="btn btn-success" role="button"><i class="fa fa-upload mr-2"></i>Sertifikat</a>
                                @endif
                                @endif
                            </td>
                            @endif
                        </tr>

                        <div class="modal fade" id="certificateModal{{ $registration->id }}" tabindex="-1" role="dialog" aria-labelledby="certificateLabel{{ $registration->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="certificateLabel{{ $registration->id }}">Sertifikat {{ $registration->user->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        @if ($registration->certificate)
                                        <img src="{{ asset('img/certificate/' . $registration->certificate->certificate_url) }}" style="width: 460px; height: auto;">
                                        @else
                                        <p>Tidak ada sertifikat</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection