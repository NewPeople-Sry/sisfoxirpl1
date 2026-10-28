<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NilaiController extends Controller
{
    public function index(): View
    {
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])
            ->latest()
            ->paginate(10);

        return view('nilai.index', compact('nilais'));
    }

    public function create(): View
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id'],
            'mapel_id' => ['required', 'exists:mapels,id'],
            'nilai_tugas' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uas' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $mapel = Mapel::findOrFail($request->mapel_id);

        $nilai_akhir = round(($request->nilai_tugas * 0.3) + ($request->nilai_uts * 0.3) + ($request->nilai_uas * 0.4), 2);
        $keterangan = $nilai_akhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        $validated['nilai_akhir'] = $nilai_akhir;
        $validated['keterangan'] = $keterangan;

        Nilai::create($validated);

        return redirect()
            ->route('nilai.index')
            ->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai): View
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        $validated = $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id'],
            'mapel_id' => ['required', 'exists:mapels,id'],
            'nilai_tugas' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uas' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $mapel = Mapel::findOrFail($request->mapel_id);

        $nilai_akhir = round(($request->nilai_tugas * 0.3) + ($request->nilai_uts * 0.3) + ($request->nilai_uas * 0.4), 2);
        $keterangan = $nilai_akhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        $validated['nilai_akhir'] = $nilai_akhir;
        $validated['keterangan'] = $keterangan;

        $nilai->update($validated);

        return redirect()
            ->route('nilai.index')
            ->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()
            ->route('nilai.index')
            ->with('success', 'Data nilai berhasil dihapus.');
    }
}