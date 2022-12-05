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

        <h5 class="card-title fw-bolder mb-3">Tambah Bakul</h5>

		<form method="post" action="{{ route('bakul.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_bakul" class="form-label">ID Bakul</label>
                <input type="text" class="form-control" id="id_bakul" name="id_bakul">
            </div>
			<div class="mb-3">
                <label for="nama_bakul" class="form-label">Nama Bakul</label>
                <input type="text" class="form-control" id="nama_bakul" name="nama_bakul">
            </div>
            <div class="mb-3">
                <label for="jenis_bakul" class="form-label">Jenis Bakul</label>
                <input type="text" class="form-control" id="jenis_bakul" name="jenis_bakul">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop