<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreInventarisRequest;
use App\Http\Requests\UpdateInventarisRequest;
use App\Models\Inventaris;
use App\Models\Kondisi;
use App\Models\Kategori;
use Illuminate\Http\Request;
class InventarisController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'totalBarang' => Inventaris::sum('jumlah'),
            'totalData' => Inventaris::count(),
            'rusakBerat' => Inventaris::whereHas(
                'kondisi',
                fn($q) => $q->where('nama', 'Rusak Berat')
            )->count(),
            'kategoriCount' => Kategori::count(),
        ]);
    }
    public function index(Request $request)
    {
        $query = Inventaris::with(['kategori', 'kondisi'])->latest();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($data) use ($q) {
                $data->where('kode_barang', 'like', "%{$q}%")
                    ->orWhere('nama_barang', 'like', "%{$q}%")
                    ->orWhere('lokasi', 'like', "%{$q}%");
            });
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        if ($request->filled('kondisi_id')) {
            $query->where('kondisi_id', $request->kondisi_id);
        }
        $inventaris = $query->paginate(5)->withQueryString();
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();
        $totalInventaris = Inventaris::count();

        $totalBaik = Inventaris::whereHas(
            'kondisi',
            fn($q) => $q->where('nama', 'Baik')
        )->count();

        $totalRingan = Inventaris::whereHas(
            'kondisi',
            fn($q) => $q->where('nama', 'Rusak Ringan')
        )->count();

        $totalBerat = Inventaris::whereHas(
            'kondisi',
            fn($q) => $q->where('nama', 'Rusak Berat')
        )->count();
        return view(
            'inventaris.index',
            compact(
                'totalInventaris',
                'totalBaik',
                'totalRingan',
                'totalBerat',
                'inventaris',
                'kategoris',
                'kondisis'
            )
        );
    }
    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();

        return view('inventaris.create', compact(
            'kategoris',
            'kondisis'
        ));
    }
    public function store(StoreInventarisRequest $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required|max:30|unique:inventaris,kode_barang',
            'nama_barang' => 'required|min:3|max:150',
            'merek' => 'nullable|max:100',
            'lokasi' => 'required|max:100',
            'kondisi_id' => 'required|exists:kondisis,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date',
            'keterangan' => 'nullable|max:1000',
        ]);
        Inventaris::create($request->validated());
        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan.');
    }
    public function show(Inventaris $inventari)
    {
        $inventari->load([
            'kategori',
            'kondisi'
        ]);
        return view('inventaris.show', ['item' => $inventari]);
    }
    public function edit(Inventaris $inventari)
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();

        return view(
            'inventaris.edit',
            [
                'item' => $inventari,
                'kategoris' => $kategoris,
                'kondisis' => $kondisis,
            ]
        );
    }
    public function update(
        UpdateInventarisRequest $request,
        Inventaris $inventari
    ) {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required|max:30|unique:inventaris,kode_barang,' . $inventari->id,
            'nama_barang' => 'required|min:3|max:150',
            'merek' => 'nullable|max:100',
            'lokasi' => 'required|max:100',
            'kondisi_id' => 'required|exists:kondisis,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date',
            'keterangan' => 'nullable|max:1000',
        ]);
        $inventari->update(
            $request->validated()
        );
        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui.');
    }
    public function destroy(Inventaris $inventari)
    {
        $inventari->delete();
        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus.');
    }
}