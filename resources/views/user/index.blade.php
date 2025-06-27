@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User</li>
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
            <div class="card-header row">
                <div class="col-md-6">
                    <form action="{{ route('userList') }}" method="GET" id="roleFilterForm">
                        <div class="d-flex align-items-center">
                            <i class="nav-icon fa fa-filter fa-lg mr-2"></i>
                            <select class="custom-select w-25" name="filter" onchange="document.getElementById('roleFilterForm').submit();">
                                <option value="" {{ request('filter') ? '' : 'selected' }}>Semua Role</option>
                                <option value="tim keuangan" {{ request('filter') == 'tim keuangan' ? 'selected' : '' }}>Tim Keuangan</option>
                                <option value="panitia" {{ request('filter') == 'panitia' ? 'selected' : '' }}>Panitia</option>
                            </select>
                        </div>
                    </form>

                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <a href="{{ route('createUser') }}" class="btn btn-primary" role="button">Tambah User</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td class="text-capitalize">{{ $user->role }}</td>
                            <td class="text-capitalize">{{ $user->status ? 'Aktif' : 'Nonaktif' }}</td>
                            <td>
                                <a href="{{ route('editUser', ['user' => $user->id]) }}" class="btn btn-warning" role="button"><i class="nav-icon fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="#deleteConfirmationModal{{ $user->id }}"><i class="nav-icon fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteConfirmationModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah ingin menghapus user <b>{{ $user->username }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="{{ route('deleteUser', ['user' => $user->id]) }}" class="btn btn-danger">Hapus</a>
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