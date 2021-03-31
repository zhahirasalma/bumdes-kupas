@extends('backend.layout.master')
@section('title')
Edit Konversi Sampah
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
                <input type="hidden" id="id" value="{{$konversi->id}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Jenis Sampah</label>
                                <input type="text" id="jenis_sampah" class="form-control form-control-alternative"
                                    placeholder="Jenis Sampah" value="{{$konversi->jenis_sampah}}">
                                <span class="text-danger error-jenis">Jenis sampah harus diisi</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Harga Sampah</label>
                                <input type="text" id="harga_konversi" class="form-control form-control-alternative"
                                    placeholder="Harga Sampah" value="{{$konversi->harga_konversi}}">
                                <span class="text-danger error-harga">Harga retribusi harus diisi</span>
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
    .error-jenis,
    .error-harga {
        display: none;
    }
</style>
@endsection

<script>
    function ubah() {
        var jenis_sampah = $('#jenis_sampah').val()
        var harga_konversi = $('#harga_konversi').val()
        var id = $('#id').val()
        var error = false;

        if (jenis_sampah === '') {
            error = true;
            $('.error-jenis').show()
        }

        if (harga_konversi === '') {
            error = true;
            $('.error-harga').show()
        }
        if (!error) {
            $.ajax({
                url: "/admin/konversi/" + id,
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "PUT",
                    jenis_sampah: jenis_sampah,
                    harga_konversi: harga_konversi
                },
                success: function (res) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di ubah!',
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if(result.value){
                            window.location.href = "/admin/konversi"
                        }
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var text = err.message;
                    Swal.fire({
                        title: 'Gagal!',
                        html: text,
                        icon: 'warning',
                    });
                }
            })
        }
    }
</script>