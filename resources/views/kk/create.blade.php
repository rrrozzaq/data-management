@extends('layouts.home')

@section('title', isset($kk) ? 'Edit Kartu Keluarga' : 'Tambah Kartu Keluarga')

@section('content')
    <h1>{{ isset($kk) ? 'Edit Kartu Keluarga' : 'Tambah Kartu Keluarga' }}</h1>

    <form action="{{ isset($kk) ? route('kk.update', $kk->id) : route('kk.store') }}" method="POST">
        @csrf
        @if(isset($kk))
            @method('PUT')
        @endif

        <!-- Nomor Kartu Keluarga (Hanya Angka) -->
        <div class="mb-3">
            <label for="nomor_kk" class="form-label">Nomor Kartu Keluarga</label>
            <input type="text" name="nomor_kk" class="form-control" value="{{ isset($kk) ? $kk->nomor_kk : '' }}" required oninput="validateNumber(this)">
        </div>

        <!-- Nama Kepala Keluarga (Hanya Huruf) -->
        <div class="mb-3">
            <label for="nama_kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
            <input type="text" name="nama_kepala_keluarga" class="form-control" value="{{ isset($kk) ? $kk->nama_kepala_keluarga : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ isset($kk) ? $kk->alamat : '' }}" required>
        </div>

        <!-- Tempat Lahir (Hanya Huruf) -->
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ isset($kk) ? $kk->tempat_lahir : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ isset($kk) ? $kk->tanggal_lahir : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-Laki" {{ isset($kk) && $kk->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="Perempuan" {{ isset($kk) && $kk->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <!-- NIK (Hanya Angka) -->
        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ isset($kk) ? $kk->nik : '' }}" required oninput="validateNumber(this)">
        </div>

        <!-- Dropdown Agama -->
        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <select name="agama" class="form-control" required>
                @foreach(config('dropdowns.agama') as $agama)
                    <option value="{{ $agama }}" {{ isset($kk) && $kk->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Pendidikan -->
        <div class="mb-3">
            <label for="pendidikan" class="form-label">Pendidikan</label>
            <select name="pendidikan" class="form-control" required>
                @foreach(config('dropdowns.pendidikan') as $pendidikan)
                    <option value="{{ $pendidikan }}" {{ isset($kk) && $kk->pendidikan == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Pekerjaan -->
        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <select name="pekerjaan" class="form-control" required>
                @foreach(config('dropdowns.pekerjaan') as $pekerjaan)
                    <option value="{{ $pekerjaan }}" {{ isset($kk) && $kk->pekerjaan == $pekerjaan ? 'selected' : '' }}>{{ $pekerjaan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Status Perkawinan -->
        <div class="mb-3">
            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
            <select name="status_perkawinan" class="form-control" required>
                @foreach(config('dropdowns.status_perkawinan') as $status)
                    <option value="{{ $status }}" {{ isset($kk) && $kk->status_perkawinan == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Status Hubungan Keluarga -->
        <div class="mb-3">
            <label for="status_hubungan_keluarga" class="form-label">Status Hubungan Keluarga</label>
            <select name="status_hubungan_keluarga" class="form-control" required>
                <option value="KEPALA KELUARGA" selected>Kepala Keluarga</option>
            </select>            
        </div>

        <!-- Dropdown Kewarganegaraan -->
        <div class="mb-3">
            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
            <select name="kewarganegaraan" class="form-control" required>
                @foreach(config('dropdowns.kewarganegaraan') as $kewarganegaraan)
                    <option value="{{ $kewarganegaraan }}" {{ isset($kk) && $kk->kewarganegaraan == $kewarganegaraan ? 'selected' : '' }}>{{ $kewarganegaraan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dokumen Imigrasi (Opsional) -->
        <div class="mb-3">
            <label for="dokumen_imigrasi" class="form-label">Dokumen Imigrasi (Opsional)</label>
            <input type="text" name="dokumen_imigrasi" class="form-control" value="{{ isset($kk) ? $kk->dokumen_imigrasi : '' }}">
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        // Fungsi validasi untuk angka
        function validateNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        // Fungsi validasi untuk teks
        function validateText(input) {
            input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        }
    </script>
@endsection
