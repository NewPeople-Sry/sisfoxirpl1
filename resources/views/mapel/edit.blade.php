@extends('layouts.main')

@section('title', 'Edit Data Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Edit Data Mata Pelajaran</h3>
                <p class="text-muted mb-0">Perbarui data mata pelajaran <strong>{{ $mapel->nama_mapel }}</strong>.</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="kode_mapel">Kode Mapel <span class="text-danger">*</span></label>
                            <input type="text" id="kode_mapel" name="kode_mapel"
                                class="form-control @error('kode_mapel') is-invalid @enderror"
                                value="{{ old('kode_mapel', $mapel->kode_mapel) }}" required>
                            @error('kode_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="kkm">Nilai KKM <span class="text-danger">*</span></label>
                            <input type="number" id="kkm" name="kkm" min="0" max="100" step="1"
                                class="form-control @error('kkm') is-invalid @enderror"
                                value="{{ old('kkm', $mapel->kkm) }}" required>
                            @error('kkm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_mapel">Nama Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" id="nama_mapel" name="nama_mapel"
                            class="form-control @error('nama_mapel') is-invalid @enderror"
                            value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                        @error('nama_mapel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('mapel.index') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Perbarui Mapel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection