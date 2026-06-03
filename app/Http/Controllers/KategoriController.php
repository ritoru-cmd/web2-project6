<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(5);

        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|max:20|unique:kategoris,kode',
            'nama' => 'required|max:100',
        ]);

        Kategori::create($validated);

        if ($request->filled('return')) {

            return redirect($request->return)
                ->with('success', 'Kategori berhasil ditambahkan.');

        }

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'kode' => 'required|max:20|unique:kategoris,kode,' . $kategori->id,
            'nama' => 'required|max:100',
        ]);

        $kategori->update($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    public function quickStore(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|max:20|unique:kategoris,kode',
            'nama' => 'required|max:100',
        ]);

        $kategori = Kategori::create($validated);

        return response()->json([
            'success' => true,
            'id' => $kategori->id,
            'nama' => $kategori->nama,
        ]);
    }
}