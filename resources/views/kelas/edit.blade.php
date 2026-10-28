@extends('layouts.main')

@section('title', 'Edit Data Kelas')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Edit Data Kelas</h3>
                <p class="text-muted mb-0">Perbarui informasi kelas <strong>{{ $kelas->nama_kelas }}</strong>.</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Kelas</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" id="nama_kelas" name="nama_kelas"
                            class="form-control @error('nama_kelas') is-invalid @enderror"
                            value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                        @error('nama_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tingkat">Tingkat</label>
                        <select id="tingkat" name="tingkat" class="form-control @error('tingkat') is-invalid @enderror"
                            required>
                            <option value="">Pilih Tingkat</option>
                            <option value="10" {{ old('tingkat', $kelas->tingkat) == '10' ? 'selected' : '' }}>10</option>
                            <option value="11" {{ old('tingkat', $kelas->tingkat) == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ old('tingkat', $kelas->tingkat) == '12' ? 'selected' : '' }}>12</option>
                        </select>
                        @error('tingkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select id="jurusan" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror"
                            required>
                            <option value="">Pilih Jurusan</option>
                            <option value="RPL" {{ old('jurusan', $kelas->jurusan) == 'RPL' ? 'selected' : '' }}>Rekayasa
                                Perangkat Lunak (RPL)</option>
                            <option value="DKV" {{ old('jurusan', $kelas->jurusan) == 'DKV' ? 'selected' : '' }}>Desain
                                Komunikasi Visual (DKV)</option>
                            <option value="MP" {{ old('jurusan', $kelas->jurusan) == 'MP' ? 'selected' : '' }}>Manajemen
                                Perkantoran (MP)</option>
                        </select>
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" id="tahun_ajaran" name="tahun_ajaran"
                            class="form-control @error('tahun_ajaran') is-invalid @enderror"
                            value="{{ old('tahun_ajaran', $kelas->tahun_ajaran) }}" required>
                        @error('tahun_ajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection