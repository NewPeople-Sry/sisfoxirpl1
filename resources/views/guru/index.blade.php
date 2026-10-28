@extends('layouts.main')

@section('title', 'Data Guru')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Data Guru</h3>
                <p class="text-muted mb-0">Kelola dan pantau seluruh data pengajar yang terdaftar.</p>
            </div>
            <a href="{{ route('guru.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Guru
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th class="text-center">L/P</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gurus as $guru)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <span class="badge badge-light border">{{ $guru->nip }}</span>
                                    </td>
                                    <td class="font-weight-bold text-dark">{{ $guru->nama }}</td>
                                    <td class="text-center">
                                        @if ($guru->jenis_kelamin === 'L')
                                            <span class="badge badge-primary px-2 py-1">L</span>
                                        @else
                                            <span class="badge badge-danger px-2 py-1">P</span>
                                        @endif
                                    </td>
                                    <td>{{ $guru->email ?? '-' }}</td>
                                    <td>{{ $guru->no_hp ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-sm btn-warning mr-1"
                                                title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru?')">
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
                                        <i class="fas fa-user-tie fa-2x mb-2 d-block"></i>
                                        Belum ada data guru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    {{ $gurus->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection