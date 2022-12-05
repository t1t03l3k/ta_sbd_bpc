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

        <h5 class="card-title fw-bolder mb-3">Ubah Data Bakul</h5>

		<form method="post" action="{{ route('bakul.update', $data->id_bakul) }}">
			@csrf
            <div class="mb-3">
                <label for="id_bakul" class="form-label">ID Bakul</label>
                <input type="text" class="form-control" id="id_bakul" name="id_bakul" value="{{ $data->id_bakul }}">
            </div>
			<div class="mb-3">
                <label for="nama_bakul" class="form-label">Nama Bakul</label>
                <input type="text" class="form-control" id="nama_bakul" name="nama_bakul" value="{{ $data->nama_bakul }}">
            </div>
            <div class="mb-3">
                <label for="tipe_bakul" class="form-label">Tipe Bakul</label>
                <input type="text" class="form-control" id="tipe_bakul" name="tipe_bakul" value="{{ $data->tipe_bakul }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop