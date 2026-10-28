@extends('layouts.main')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-graduate mr-2 text-primary"></i>Detail Profil Siswa
            </h1>
            <div>
                <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning shadow-sm mr-1">
                    <i class="fas fa-edit fa-sm mr-1"></i> Edit Siswa
                </a>
                <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Biodata Siswa</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th width="35%">NIS</th>
                                <td width="5%">:</td>
                                <td><span class="badge badge-light border font-weight-bold">{{ $siswa->nis }}</span></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td class="font-weight-bold text-dark">{{ $siswa->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td>
                                    @if ($siswa->jenis_kelamin === 'L')
                                        <span class="badge badge-primary px-2 py-1">Laki-laki</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1">Perempuan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>No. Handphone</th>
                                <td>:</td>
                                <td>{{ $siswa->no_hp ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th width="35%">Kelas</th>
                                <td width="5%">:</td>
                                <td>
                                    <span class="badge badge-info px-2 py-1">
                                        {{ $siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>:</td>
                                <td>{{ $siswa->kelas->jurusan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Ajaran</th>
                                <td>:</td>
                                <td>{{ $siswa->kelas->tahun_ajaran ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>{{ $siswa->alamat ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-star mr-1 text-warning"></i> Rekapitulasi Nilai Siswa
                </h6>
                <a href="{{ route('nilai.create') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Input Nilai
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Mata Pelajaran</th>
                                <th width="10%" class="text-center">KKM</th>
                                <th class="text-center">Nilai Tugas (30%)</th>
                                <th class="text-center">Nilai UTS (30%)</th>
                                <th class="text-center">Nilai UAS (40%)</th>
                                <th class="text-center">Nilai Akhir</th>
                                <th class="text-center">Status</th>
                                <th width="12%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswa->nilais as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="font-weight-bold">{{ $item->mapel->nama_mapel ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-secondary">{{ $item->mapel->kkm ?? '-' }}</span>
                                    </td>
                                    <td class="text-center">{{ $item->nilai_tugas }}</td>
                                    <td class="text-center">{{ $item->nilai_uts }}</td>
                                    <td class="text-center">{{ $item->nilai_uas }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info p-2 h6 mb-0">{{ $item->nilai_akhir }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-{{ $item->keterangan == 'Lulus' ? 'success' : 'danger' }} p-2">
                                            <i
                                                class="fas fa-{{ $item->keterangan == 'Lulus' ? 'check-circle' : 'times-circle' }} mr-1"></i>
                                            {{ $item->keterangan }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        Belum ada data nilai akademik untuk siswa ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection