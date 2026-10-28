@extends('layouts.main')

@section('title', 'Data Kelas')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Data Kelas</h3>
                <p class="text-muted mb-0">Kelola informasi data kelas dan rombongan belajar.</p>
            </div>
            <a href="{{ route('kelas.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Kelas
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Nama Kelas</th>
                                <th class="text-center">Tingkat</th>
                                <th>Jurusan</th>
                                <th class="text-center">Tahun Ajaran</th>
                                <th class="text-center">Jumlah Siswa</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas as $item)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}
                                    </td>
                                    <td class="font-weight-bold text-dark">{{ $item->nama_kelas }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-secondary px-2 py-1">Kelas {{ $item->tingkat }}</span>
                                    </td>
                                    <td>{{ $item->jurusan }}</td>
                                    <td class="text-center">{{ $item->tahun_ajaran }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info px-2 py-1">
                                            {{ $item->siswas_count ?? $item->siswas->count() }} Siswa
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-sm btn-warning mr-1"
                                                title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('kelas.destroy', $item->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus kelas {{ $item->nama_kelas }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        Belum ada data kelas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    {{ $kelas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection