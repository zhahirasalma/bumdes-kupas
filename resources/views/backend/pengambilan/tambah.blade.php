@extends('backend.layout.master')
@section('title')
Tambah Pengambilan
@endsection


@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Form Tambah</h3>
                    </div>
                    <div class="col text-right">
                        <button type="button" id="button-tambah" onclick="tambah()"
                            class="btn btn-success">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Waktu Pengambilan</label>
                            <input type="date" id="waktu_pengambilan" name="waktu_pengambilan"
                                class="form-control form-control-alternative" placeholder="Waktu Pengambilan"
                                value="{{old('waktu_pengambilan')}}">
                            @if ($errors->has('waktu_pengambilan'))
                            <span class="text-danger">{{ $errors->first('waktu_pengambilan') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Tampilkan berdasarkan</label>
                            <select name="kategori" id="kategori" class="form-control filter">
                                <option value="0">Semua Warga</option>
                                @foreach(App\Models\KategoriSampah::all() as $k)
                                <option value="{{$k->id}}" @if (old('kategori')==$k->id )
                                    selected="selected" @endif>{{$k->jenis_sampah}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kategori'))
                            <span class="text-danger">{{ $errors->first('kategori') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{route('pengambilan.store')}}" method="POST">
                @csrf
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="tabel">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <input type="checkbox" id="cb-head">
                                </th>
                                <th scope="col">Nama Warga</th>
                                <th scope="col">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    var selected_rows = [];
    let filter = $("#kategori").val()
    const tabel = $('#tabel').DataTable({
        "pageLength": 100,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'semua']
        ],
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "processing": true,
        "bServerSide": true,
        "order": [
            [1, "asc"]
        ],
        "autoWidth": false,
        "ajax": {
            url: "{{route('data')}}",
            type: "POST",
            data: function (d) {
                d.filter = filter;
                return d
            }
        },
        columnDefs: [{
                "targets": 0,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return `<input type="checkbox" class="cb-child" value="${row.id_users}">`;
                }
            },
            {
                "targets": 1,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.nama;
                }
            },
            {
                "targets": 2,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.jenis_sampah;
                }
            }
        ]
    });

    $('#kategori').select2({
        allowClear: true,
        theme: 'bootstrap4',
    });

    //filter data by kategori
    $(".filter").on('change', function () {
        filter = $("#kategori").val()
        tabel.ajax.reload(function () {
            if(selected_rows.length > 0){
                $(".cb-child").val(selected_rows).is(':checked');
            }
        })
    })

    //checkbox
    $("#cb-head").on('click', function () {
        var isChecked = $("#cb-head").prop('checked')
        $(".cb-child").prop('checked', isChecked)
    })

    $("#tabel tbody").on('click', '.cb-child', function () {
        if ($(this).prop('checked') != true) {
            $("#cb-head").prop('checked', false)
        }
    })

    //tambah data
    function tambah() {
        let checkbox_terpilih = $("#tabel tbody .cb-child:checked")
        let semua_id = []
        let waktu = $('#waktu_pengambilan').val()
        $.each(checkbox_terpilih, function (index, elm) {
            semua_id.push(elm.value)
        })
        $.ajax({
            url: "{{route('pengambilan/tambah')}}",
            method: 'post',
            data: {
                id_users: semua_id,
                waktu: waktu
            },
            success: function (res) {
                window.location.href = "/admin/pengambilan"
            }
        })
    }


    //save selected cb
    $("#tabel tbody").on('click', '.cb-child', function () {
        var isChecked = $(this).is(':checked')
        if (isChecked) {
            let checked = $(this)[0].value;
            selected_rows.push(checked);
        } else {
            let uncheck = $(this)[0].value;
            var index = selected_rows.indexOf(uncheck);
            selected_rows.splice(index, 1);
        }
    })

</script>
@endpush
