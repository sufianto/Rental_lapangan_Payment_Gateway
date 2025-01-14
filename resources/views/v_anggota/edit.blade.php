<h3> {{ $judul }} </h3>
<form action="{{ route('anggota.update', $edit->id) }}" method="post">
    @method('put')
    @csrf
    <label>Nama</label><br>
    <input type="text" name="nama" id="" value="{{ old('nama', $edit->nama) }}" placeholder="Masukkan Nama Lengkap" class="form-control @error('nama') is-invalid @enderror">
    @error('nama')
        <span class="invalid-feedback alert-danger" role="alert">
            {{ $message }}
        </span>
        WEB PROGRAMMING II 39
    @enderror
    <p></p>
    <label>HP</label><br>
    <input type="text" name="hp" id="" value="{{ old('hp', $edit->hp) }}"
        placeholder="Masukkan Nomor HP" class="form-control @error('hp') is-invalid @enderror">
    @error('hp')
        <span class="invalid-feedback alert-danger" role="alert">
            {{ $message }}
        </span>
    @enderror
    <p></p>
    <button type="submit">Perbaharui</button>
    <a href="{{ route('anggota.index') }}">
        <button type="button">Batal</button>
    </a>
</form>
