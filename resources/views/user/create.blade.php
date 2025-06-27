@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('userList')}}">User</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
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
                <form action="{{ route('storeUser') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="txtName">Nama</label>
                        <input type="text" id="txtName" name="txtName" class="form-control" required placeholder="Nama">
                    </div>

                    <div class="form-group">
                        <label for="txtUsername">Username</label>
                        <input type="text" id="txtUsername" name="txtUsername" class="form-control" required placeholder="Username">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 position-relative">
                            <label for="txtPassword">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="txtPassword" name="txtPassword" required placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('txtPassword', this)" style="cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 position-relative">
                            <label for="txtConfPassword">Ulang Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="txtConfPassword" name="txtConfPassword" required placeholder="Ulang Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('txtConfPassword', this)" style="cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtRole">Role</label>
                            <select class="custom-select" id="txtRole" name="txtRole" required>
                                <option value="tim keuangan" selected>Tim Keuangan</option>
                                <option value="panitia">Panitia</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtStatus">Status</label>
                            <select class="custom-select" id="txtStatus" name="txtStatus" required>
                                <option value="1" selected>Aktif</option>
                                <option value="0">Nonaktif</option>
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

<script>
    function togglePassword(inputId, iconSpan) {
        const input = document.getElementById(inputId);
        const icon = iconSpan.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

@endsection