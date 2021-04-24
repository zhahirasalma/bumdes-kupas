@extends('backend.layout.master')
@section('title')
Edit Kategori Sampah
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
                <input type="hidden" id="id" value="{{$kategori->id}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Jenis Sampah</label>
                                <input type="text" id="jenis_sampah" class="form-control form-control-alternative"
                                    placeholder="Jenis Sampah" value="{{$kategori->jenis_sampah}}">
                                <span class="text-danger error-jenis">Jenis sampah harus diisi</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Harga Retribusi</label>
                                <input type="text" id="harga_retribusi" class="form-control form-control-alternative"
                                    placeholder="Harga Retribusi" value="{{$kategori->harga_retribusi}}">
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
        var harga_retribusi = $('#harga_retribusi').val()
        var id = $('#id').val()
        var error = false;

        if (jenis_sampah === '') {
            error = true;
            $('.error-jenis').show()
        }

        if (harga_retribusi === '') {
            error = true;
            $('.error-harga').show()
        }
        if (!error) {
            $.ajax({
                url: "/admin/kategori_sampah/" + id,
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "PUT",
                    jenis_sampah: jenis_sampah,
                    harga_retribusi: harga_retribusi
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
                            window.location.href = "/admin/kategori_sampah"
                        }
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var text = err.errors;
                    var msg = ''
                    var msg1 = ''
                    
                    if(text.jenis_sampah){
                        msg = text.jenis_sampah[0] + '<br>'
                    }
                    
                    if(text.harga_retribusi){
                        msg1 = text.harga_retribusi[0] + '<br>'
                    }
                    
                    Swal.fire({
                        title: 'Gagal!',
                        html: msg + msg1,
                        icon: 'warning',
                    });
                }
            })
        }
    }

</script>
