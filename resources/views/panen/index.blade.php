@extends('panen.layout')

@section('content')

<p>Cari Data:</p>
<div class="pb-3">
    <form class="d-flex" action="{{ url('/') }}" method="get">
        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
        <button class="btn btn-secondary" type="submit">Cari</button>
    </form>
</div>

<h4 class="mt-5">Data Panen</h4>

<a href="{{ route('panen.create') }}" type="button" class="btn btn-success rounded-3">Tambah Panen</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>No.</th>
        <th>ID Bakul</th>
        <th>ID Kandang</th>
        <th>Jumlah Ekor</th>
        <th>Bobot (kg)</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_panen }}</td>
                <td>{{ $data->id_bakul }}</td>
                <td>{{ $data->id_kandang }}</td>
                <td>{{ $data->ekor }}</td>
                <td>{{ $data->kg }}</td>
                <td>
                    <a href="{{ route('panen.edit', $data->id_panen) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_panen }}">
                        HAPUS
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $data->id_panen }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('panen.delete', $data->id_panen) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data {{ $data->id_panen}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskecilModal{{ $data->id_panen }}">
                        hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapuskecilModal{{ $data->id_panen }}" tabindex="-1" aria-labelledby="hapuskecilModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapuskecilModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('panen.softdelete', $data->id_panen) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data {{ $data->id_panen}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Data Kandang</h4>

<a href="{{ route('kandang.create') }}" type="button" class="btn btn-success rounded-3">Tambah Kandang</a>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>ID Kandang</th>
        <th>Nama Kandang</th>
        <th>Lokasi</th>
        <th>Supervisor</th>
        <th>Jenis Kandang</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($kandang as $kandangs)
            <tr>
                <td>{{ $kandangs->id_kandang }}</td>
                <td>{{ $kandangs->nama_kandang }}</td>
                <td>{{ $kandangs->lokasi }}</td>
                <td>{{ $kandangs->spv }}</td>
                <td>{{ $kandangs->jenis_kandang }}</td>
                <td>
                    <a href="{{ route('kandang.edit', $kandangs->id_kandang) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $kandangs->id_kandang }}">
                        HAPUS
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $kandangs->id_kandang }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('kandang.delete', $kandangs->id_kandang) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus {{ $kandangs->nama_kandang}} ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskecilModal{{ $kandangs->id_kandang }}">
                        hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapuskecilModal{{ $kandangs->id_kandang }}" tabindex="-1" aria-labelledby="hapuskecilModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapuskecilModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('kandang.softdelete', $kandangs->id_kandang) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data {{ $kandangs->id_kandang}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Data Bakul</h4>

<a href="{{ route('bakul.create') }}" type="button" class="btn btn-success rounded-3">Tambah Bakul</a>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>ID Bakul</th>
        <th>Nama Bakul</th>
        <th>Jenis Bakul</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($bakul as $bakuls)
            <tr>
                <td>{{ $bakuls->id_bakul }}</td>
                <td>{{ $bakuls->nama_bakul }}</td>
                <td>{{ $bakuls->jenis_bakul }}</td>
                <td>
                    <a href="{{ route('bakul.edit', $bakuls->id_bakul) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $bakuls->id_bakul }}">
                        HAPUS
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $bakuls->id_bakul }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('bakul.delete', $bakuls->id_bakul) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus {{ $bakuls->nama_bakul}} ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskecilModal{{ $bakuls->id_bakul }}">
                        hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapuskecilModal{{ $bakuls->id_bakul }}" tabindex="-1" aria-labelledby="hapusbakulModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapuskecilModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('bakul.softdelete', $bakuls->id_bakul) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data {{ $bakuls->id_bakul}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Join Panen dan Kandang</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Nama Kandang</th>
        <th>Lokasi</th>
        <th>Supervisor</th>
        <th>Jenis Kandang</th>
        <th>Jumlah Ekor</th>
        <th>Bobot (kg)</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins2 as $join2)
        <tr>
            <td>{{ $join2->nama_kandang }}</td>
            <td>{{ $join2->lokasi }}</td>
            <td>{{ $join2->spv }}</td>
            <td>{{ $join2->jenis_kandang }}</td>
            <td>{{ $join2->ekor }}</td>
            <td>{{ $join2->kg }}</td>
    @endforeach
</tbody>
</table>

<h4 class="mt-5">Join Panen dan Bakul</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Nama Bakul</th>
        <th>Jenis Bakul</th>
        <th>Jumlah Ekor</th>
        <th>Bobot (kg)</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama_bakul }}</td>
            <td>{{ $join->jenis_bakul }}</td>
            <td>{{ $join->ekor }}</td>
            <td>{{ $join->kg }}</td>
    @endforeach
</tbody>
</table>
@stop
