<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col"><span>
                    <h3 class="mb-0">REKAPAN SETOR SAMPAH AN ORGANIK </h3>
                    <h3 class="mb-0"> BANK SAMPAH @if (!empty($detail[0]->user->nama))
                        {{$detail[0]->user->nama}}
                        @else

                        @endif
                    </h3>
                </span>
            </div>
            <div class="col">
                <h3 class="mb-0">PENGAMBILAN : </h3>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush" id="tabel">
            <thead class="thead-light">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">URAIAN</th>
                    <th scope="col">VOLUME</th>
                    <th scope="col">HARGA SATUAN</th>
                    <th scope="col">TOTAL HARGA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail as $d)
                <tr>
                    <th scope="row">
                        {{$loop->iteration}}
                    </th>
                    <td>
                        {{$d->konversi->jenis_sampah}}
                    </td>
                    <td>
                        {{$d->berat}}
                    </td>
                    <td>
                        @currency($d->konversi->harga_konversi)
                    </td>
                    <td>
                        @currency($d->harga_total)
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
