<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MapelController extends Controller
{
    public function index(): View
    {
        $mapels = Mapel::orderBy('nama_mapel')->paginate(10);

        return view('mapel.index', compact('mapels'));
    }

    public function create(): View
    {
        return view('mapel.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_mapel' => ['required', 'string', 'max:255', 'unique:mapels,kode_mapel'],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'kkm' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        Mapel::create($validated);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel): View
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel): RedirectResponse
    {
        $validated = $request->validate([
            'kode_mapel' => [
                'required',
                'string',
                'max:255',
                Rule::unique('mapels', 'kode_mapel')->ignore($mapel->id),
            ],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'kkm' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $mapel->update($validated);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel): RedirectResponse
    {
        if ($mapel->nilais()->exists()) {
            return redirect()
                ->route('mapel.index')
                ->with('error', 'Mata pelajaran tidak dapat dihapus karena masih memiliki data nilai.');
        }

        $mapel->delete();

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data mata pelajaran berhasil dihapus.');
    }
}