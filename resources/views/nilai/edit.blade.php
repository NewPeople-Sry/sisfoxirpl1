@extends('layouts.main')

@section('title', 'Edit Nilai Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit mr-2 text-primary"></i>Edit Nilai Siswa</h1>
        <a href="{{ route('nilai.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Nilai</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="siswa_id">Siswa <span class="text-danger">*</span></label>
                        <select
                            id="siswa_id"
                            name="siswa_id"
                            class="form-control @error('siswa_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option
                                    value="{{ $siswa->id }}"
                                    {{ old('siswa_id', $nilai->siswa_id) == $siswa->id ? 'selected' : '' }}
                                >
                                    {{ $siswa->nama }} ({{ $siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}) - NIS: {{ $siswa->nis }}
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="mapel_id">Mata Pelajaran <span class="text-danger">*</span></label>
                        <select
                            id="mapel_id"
                            name="mapel_id"
                            class="form-control @error('mapel_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach ($mapels as $mapel)
                                <option
                                    value="{{ $mapel->id }}"
                                    {{ old('mapel_id', $nilai->mapel_id) == $mapel->id ? 'selected' : '' }}
                                >
                                    {{ $mapel->nama_mapel }} (KKM: {{ $mapel->kkm }})
                                </option>
                            @endforeach
                        </select>
                        @error('mapel_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="nilai_tugas">Nilai Tugas (30%) <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            id="nilai_tugas"
                            name="nilai_tugas"
                            min="0"
                            max="100"
                            step="0.01"
                            class="form-control @error('nilai_tugas') is-invalid @enderror"
                            value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}"
                            required
                        >
                        @error('nilai_tugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="nilai_uts">Nilai UTS (30%) <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            id="nilai_uts"
                            name="nilai_uts"
                            min="0"
                            max="100"
                            step="0.01"
                            class="form-control @error('nilai_uts') is-invalid @enderror"
                            value="{{ old('nilai_uts', $nilai->nilai_uts) }}"
                            required
                        >
                        @error('nilai_uts')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="nilai_uas">Nilai UAS (40%) <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            id="nilai_uas"
                            name="nilai_uas"
                            min="0"
                            max="100"
                            step="0.01"
                            class="form-control @error('nilai_uas') is-invalid @enderror"
                            value="{{ old('nilai_uas', $nilai->nilai_uas) }}"
                            required
                        >
                        @error('nilai_uas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('nilai.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Perbarui Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection