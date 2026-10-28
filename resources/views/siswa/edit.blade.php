@extends('layouts.main')

@section('title', 'Edit Data Siswa')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Edit Data Siswa</h3>
                <p class="text-muted mb-0">Perbarui data siswa <strong>{{ $siswa->nama }}</strong>.</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nis">NIS <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="nis"
                                name="nis"
                                class="form-control @error('nis') is-invalid @enderror"
                                value="{{ old('nis', $siswa->nis) }}"
                                required
                            >
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $siswa->nama) }}"
                                required
                            >
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
                            <select
                                id="kelas_id"
                                name="kelas_id"
                                class="form-control @error('kelas_id') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $itemKelas)
                                    <option
                                        value="{{ $itemKelas->id }}"
                                        {{ old('kelas_id', $siswa->kelas_id) == $itemKelas->id ? 'selected' : '' }}
                                    >
                                        {{ $itemKelas->nama_kelas }} ({{ $itemKelas->tahun_ajaran }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                required
                            >
                                <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="no_hp">No. HP <small class="text-muted">(Opsional)</small></label>
                            <input
                                type="tel"
                                id="no_hp"
                                name="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp', $siswa->no_hp) }}"
                            >
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="alamat">Alamat <small class="text-muted">(Opsional)</small></label>
                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="3"
                                class="form-control @error('alamat') is-invalid @enderror"
                            >{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Perbarui Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection