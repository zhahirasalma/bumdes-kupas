@extends('backend.layout.master')
@section('title')
Daftar Pengambilan Sampah
@endsection


@section('content')

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">@yield('title')</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{route('reset')}}" type="button" id="button-reset" class="btn btn-danger">Reset
                            data</a>
                        <a href="{{route('pengambilan.create')}}" class="btn btn-success">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush" id="tabel">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Warga</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tanggal Pengambilan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengambilan as $p)
                        <tr>
                            <th scope="row">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                {{$p->user->nama}}
                            </td>
                            <td>
                                {{$p->warga->lokasi}}
                            </td>
                            <td>
                                {{$p->waktu_pengambilan}}
                            </td>
                            <td>
                                <style>
                                    .toggle.ios,
                                    .toggle-on.ios,
                                    .toggle-off.ios {
                                        border-radius: 20px;
                                    }

                                    .toggle.ios .toggle-handle {
                                        border-radius: 20px;
                                    }

                                </style>
                                <input data-style="ios" data-size="sm" data-id="{{$p->id}}" class="toggle-class"
                                    type="checkbox" data-toggle="toggle" data-onstyle="outline-danger"
                                    data-offstyle="outline-success" data-off="Terambil" data-on="Belum diambil"
                                    {{$p->status ? 'checked' : ''}}>

                            </td>
                            <td>
                                <form action="{{ route('pengambilan.destroy', $p->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" type="submit"><i
                                            class="far fa-trash-alt"></i></button>
                            </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@push('script')
<script>
    var table = $('#tabel').DataTable({

    });

    $(function () {
        $('.toggle-class').change(function () {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{route('ubahstatus')}}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function (data) {
                    console.log('Success')
                },
            });
        });
    });

</script>
@endpush
