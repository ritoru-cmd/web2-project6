<div style="display:flex;justify-content:space-between;align-items:center;">

    <label>Kategori</label>
    <button type="button" onclick="openKategoriModal()" class="btn" style="padding:5px 10px;font-size:12px;">

        + Tambah Kategori

    </button>


</div>
<select name="kategori_id">
    <option value="">-- Pilih Kategori --</option>

    @foreach ($kategoris as $kategori)
        <option value="{{ $kategori->id }}" @selected(old('kategori_id', $item->kategori_id ?? '') == $kategori->id)>
            {{ $kategori->nama }}
        </option>
    @endforeach
</select>

@error('kategori_id')
    <div class="alert-error">{{ $message }}</div>
@enderror

<label>Kode Barang</label>
<input type="text" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang ?? '') }}">

@error('kode_barang')
    <div class="alert-error">{{ $message }}</div>
@enderror

<label>Nama Barang</label>
<input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang ?? '') }}">

@error('nama_barang')
    <div class="alert-error">{{ $message }}</div>
@enderror

<label>Merek</label>
<input type="text" name="merek" value="{{ old('merek', $item->merek ?? '') }}">

<label>Lokasi</label>
<input type="text" name="lokasi" value="{{ old('lokasi', $item->lokasi ?? '') }}">

@error('lokasi')
    <div class="alert-error">{{ $message }}</div>
@enderror

<label>Kondisi</label>

<select name="kondisi_id">

    <option value="">
        -- Pilih Kondisi --
    </option>

    @foreach ($kondisis as $kondisi)

        <option value="{{ $kondisi->id }}" @selected(old('kondisi_id', $item->kondisi_id ?? '') == $kondisi->id)>

            {{ $kondisi->nama }}

        </option>

    @endforeach

</select>

@error('kondisi_id')
    <div class="alert-error">
        {{ $message }}
    </div>
@enderror

<label>Jumlah</label>
<input type="number" min="1" name="jumlah" value="{{ old('jumlah', $item->jumlah ?? 1) }}">

<label>Tanggal Pengadaan</label>
<input type="date" name="tanggal_pengadaan" value="{{ old('tanggal_pengadaan', $item->tanggal_pengadaan ?? '') }}">

<label>Keterangan</label>
<textarea name="keterangan" rows="4">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>

<p style="margin-top:18px;">
    <button class="btn btn-primary" type="submit">
        Simpan
    </button>

    <a class="btn btn-secondary" href="{{ route('inventaris.index') }}">
        Kembali
    </a>
</p>

<div id="kategoriModal" style="display:none;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,.4);">

    <div style="
        background:white;
        width:400px;
        margin:100px auto;
        padding:20px;
        border-radius:10px;">

        <h3>Tambah Kategori</h3>

        <label>Kode</label>
        <input type="text" id="quickKode">

        <label>Nama</label>
        <input type="text" id="quickNama">

        <div style="margin-top:15px;">

            <button type="button" class="btn" onclick="saveKategori()">

                Simpan

            </button>

            <button type="button" class="btn btn-secondary" onclick="closeKategoriModal()">

                Tutup

            </button>

        </div>

    </div>

</div>

<script>

    function openKategoriModal() {
        document.getElementById('kategoriModal').style.display = 'block';
    }

    function closeKategoriModal() {
        document.getElementById('kategoriModal').style.display = 'none';
    }

    async function saveKategori() {
        const kode = document.getElementById('quickKode').value;
        const nama = document.getElementById('quickNama').value;

        const response = await fetch(
            "{{ route('kategori.quick-store') }}",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    kode,
                    nama
                })
            }
        );

        const data = await response.json();

        if (data.success) {
            const select =
                document.querySelector(
                    'select[name="kategori_id"]'
                );

            const option =
                new Option(
                    data.nama,
                    data.id,
                    true,
                    true
                );

            select.add(option);

            closeKategoriModal();

            document.getElementById('quickKode').value = '';
            document.getElementById('quickNama').value = '';
        }
    }

</script>