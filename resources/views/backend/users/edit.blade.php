@extends('backend.layout.master')
@section('title')
Edit Users
@endsection

<head>
    <link rel=”stylesheet” href="{{asset('swal/sweetalert.css')}}">
    <script src="{{asset('swal/sweetalert.js')}}"></script>
</head>

@section('content')
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Form Edit</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <input type="hidden" id="id" value="{{$users->id}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Nama</label>
                            <input type="text" id="nama" class="form-control form-control-alternative"
                                placeholder="Nama" value="{{$users->nama}}">
                            <span class="text-danger error-nama">Nama harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Email</label>
                            <input type="email" id="email" class="form-control form-control-alternative"
                                placeholder="Email" value="{{$users->email}}">
                            <span class="text-danger error-email">Email harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Password</label>
                            <input type="password" id="password" class="form-control form-control-alternative"
                                placeholder="Password" value="">
                            <span class="text-danger error-password">Password harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Role</label>
                            <select id="role" class="form-control form-control-alternative" placeholder="Role">
                                <option value="">Pilih...</option>
                                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>
                                    admin</option>
                                <option value="educator" {{ $users->role == 'educator' ? 'selected' : '' }}>
                                    educator</option>
                            </select>
                            <span class="text-danger error-role">Pilih salah satu</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button class=" btn btn-success" onClick="ubah()" type="submit">Ubah</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .error-nama,
    .error-email,
    .error-password,
    .error-role {
        display: none;
    }

</style>
@endsection

<script>
    function ubah() {
        var nama = $('#nama').val()
        var email = $('#email').val()
        var password = $('#password').val()
        var role = $('#role').val()
        var id = $('#id').val()
        var error = false;

        if (nama === '') {
            error = true;
            $('.error-nama').show()
        }

        if (email === '') {
            error = true;
            $('.error-email').show()
        }

        if (password === '') {
            error = true;
            $('.error-password').show()
        }

        if (role === '') {
            error = true;
            $('.error-role').show()
        }
        if (!error) {
            $.ajax({
                url: "/admin/users/" + id,
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "PUT",
                    nama: nama,
                    email: email,
                    password: password,
                    role: role
                },
                success: function (res) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di tambahkan!',
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if(result.value){
                            window.location.href = "/admin/users"
                        }
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var text = err.errors;
                    var msg1 = ' '
                    var msg2 = ' '
                    var msg3 = ' '

                    if (text.nama) {
                        msg1 = text.nama[0];
                    }

                    if (text.email) {
                        msg2 = text.email[0];
                    }

                    if (text.password) {
                        msg3 = text.password[0];
                    }

                    Swal.fire({
                        title: 'Gagal!',
                        html: msg1 + '<br>' + msg2 + '<br>' + msg3,
                        icon: 'warning',
                    });
                }
            })
        }
    }

</script>
