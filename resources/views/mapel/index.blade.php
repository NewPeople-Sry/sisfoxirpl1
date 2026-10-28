@extends('layouts.main')

@section('title', 'Data Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Data Mata Pelajaran</h3>
                <p class="text-muted mb-0">Kelola daftar mata pelajaran dan kriteria ketuntasan minimal (KKM).</p>
            </div>
            <a href="{{ route('mapel.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Mapel
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%" class="text-center">Kode Mapel</th>
                                <th>Nama Mata Pelajaran</th>
                                <th width="12%" class="text-center">KKM</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mapels as $item)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($mapels->currentPage() - 1) * $mapels->perPage() }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-secondary px-2 py-1 font-weight-normal">
                                            {{ $item->kode_mapel }}
                                        </span>
                                    </td>
                                    <td class="font-weight-bold text-dark">{{ $item->nama_mapel }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info px-2 py-1 font-weight-bold">
                                            {{ $item->kkm }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('mapel.edit', $item->id) }}" class="btn btn-sm btn-warning mr-1"
                                                title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('mapel.destroy', $item->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus mapel {{ $item->nama_mapel }}?')">
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
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-book-open fa-2x mb-2 d-block"></i>
                                        Belum ada data mata pelajaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    {{ $mapels->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection