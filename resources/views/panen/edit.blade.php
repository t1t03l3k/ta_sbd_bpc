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

        <h5 class="card-title fw-bolder mb-3">Ubah Data Panen</h5>

		<form method="post" action="{{ route('panen.update', $data->id_panen) }}">
			@csrf
            <div class="mb-3">
                <label for="id_panen" class="form-label">ID Panen</label>
                <input type="text" class="form-control" id="id_panen" name="id_panen" value="{{ $data->id_panen }}">
            </div>
			<div class="mb-3">
                <label for="id_bakul" class="form-label">Bakul</label>
                <input type="text" class="form-control" id="id_bakul" name="id_bakul" value="{{ $data->id_bakul }}">
            </div>
            <div class="mb-3">
                <label for="id_kandang" class="form-label">Kandang</label>
                <input type="text" class="form-control" id="id_kandang" name="id_kandang" value="{{ $data->id_kandang }}">
            </div>
            <div class="mb-3">
                <label for="ekor" class="form-label">Jumlah Ekor</label>
                <input type="text" class="form-control" id="ekor" name="ekor" value="{{ $data->ekor }}">
            </div>
            <div class="mb-3">
                <label for="kg" class="form-label">Bobot</label>
                <input type="text" class="form-control" id="kg" name="kg" value="{{ $data->kg }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop