@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('userList')}}">User</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
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
                <form action="{{ route('updateUser', ['user' => $user->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="txtName">Nama</label>
                        <input type="text" id="txtName" name="txtName" class="form-control" required placeholder="Nama" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="txtUsername">Username</label>
                        <input type="text" id="txtUsername" name="txtUsername" class="form-control" required placeholder="Username" value="{{ $user->username }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtRole">Role</label>
                            <select class="custom-select" id="txtRole" name="txtRole" required>
                                <option value="{{ $user->role }}" selected>{{ ucwords($user->role) }}</option>
                                @if ($user->role == 'tim keuangan')
                                <option value="panitia">Panitia</option>
                                @else
                                <option value="tim keuangan">Tim Keuangan</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtStatus">Status</label>
                            <select class="custom-select" id="txtStatus" name="txtStatus" required>
                                @if ($user->status == 1)
                                <option value="1" selected>Aktif</option>
                                <option value="0">Nonaktif</option>
                                @else
                                <option value="0" selected>Nonaktif</option>
                                <option value="1">Aktif</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('userList') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection