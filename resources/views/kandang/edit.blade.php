@extends('panen.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Kandang</h5>

		<form method="post" action="{{ route('kandang.update', $data->id_kandang) }}">
			@csrf
            <div class="mb-3">
                <label for="id_kandang" class="form-label">ID Kandang</label>
                <input type="text" class="form-control" id="id_kandang" name="id_kandang" value="{{ $data->id_kandang }}">
            </div>
			<div class="mb-3">
                <label for="nama_kandang" class="form-label">Nama Kandang</label>
                <input type="text" class="form-control" id="nama_kandang" name="nama_kandang" value="{{ $data->nama_kandang }}">
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi Kandang</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $data->lokasi }}">
            </div>
            <div class="mb-3">
                <label for="spv" class="form-label">Supervisor</label>
                <input type="text" class="form-control" id="spv" name="spv" value="{{ $data->spv }}">
            </div>
            <div class="mb-3">
                <label for="jenis_kandang" class="form-label">Jenis Kandang</label>
                <input type="text" class="form-control" id="jenis_kandang" name="jenis_kandang" value="{{ $data->jenis_kandang }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop