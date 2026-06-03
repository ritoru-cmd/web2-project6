<label>Kode Kategori</label>
<input type="text" name="kode" value="{{ old('kode', $kategori->kode ?? '') }}">

@error('kode')
    <div class="alert-error">{{ $message }}</div>
@enderror

<label>Nama Kategori</label>
<input type="text" name="nama" value="{{ old('nama', $kategori->nama ?? '') }}">

@error('nama')
    <div class="alert-error">{{ $message }}</div>
@enderror

<p style="margin-top:18px;">
    <button class="btn" type="submit">
        Simpan
    </button>

    <a class="btn btn-secondary" href="{{ route('kategori.index') }}">
        Kembali
    </a>
</p>