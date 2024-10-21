@extends('layouts.home')

@section('title', isset($ktp) ? 'Edit KTP' : 'Tambah KTP')

@section('content')
    <h1>{{ isset($ktp) ? 'Edit KTP' : 'Tambah KTP' }}</h1>

    <form action="{{ isset($ktp) ? route('ktp.update', $ktp->id) : route('ktp.store') }}" method="POST">
        @csrf
        @if(isset($ktp))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="kk_id" class="form-label">Kartu Keluarga</label>
            <select name="kk_id" class="form-control" required>
                @foreach($kks as $kk)
                    <option value="{{ $kk->id }}" {{ isset($ktp) && $ktp->kk_id == $kk->id ? 'selected' : '' }}>
                        {{ $kk->nomor_kk }} - {{ $kk->nama_kepala_keluarga }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- NIK (Hanya Angka) -->
        <div class="mb-3">
            <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
            <input type="text" name="nik" class="form-control" value="{{ isset($ktp) ? $ktp->nik : '' }}" required oninput="validateNumber(this)">
        </div>

        <!-- Nama (Hanya Huruf) -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ isset($ktp) ? $ktp->nama : '' }}" required>
        </div>

        <!-- Tempat Lahir (Hanya Huruf) -->
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ isset($ktp) ? $ktp->tempat_lahir : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ isset($ktp) ? $ktp->tanggal_lahir : '' }}" required>
        </div>

        <!-- Dropdown Jenis Kelamin -->
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-Laki" {{ isset($ktp) && $ktp->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="Perempuan" {{ isset($ktp) && $ktp->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ isset($ktp) ? $ktp->alamat : '' }}" required>
        </div>

        <!-- Dropdown Agama -->
        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <select name="agama" class="form-control" required>
                @foreach(config('dropdowns.agama') as $agama)
                    <option value="{{ $agama }}" {{ isset($ktp) && $ktp->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Status Perkawinan -->
        <div class="mb-3">
            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
            <select name="status_perkawinan" class="form-control" required>
                @foreach(config('dropdowns.status_perkawinan') as $status)
                    <option value="{{ $status }}" {{ isset($ktp) && $ktp->status_perkawinan == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Pekerjaan -->
        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <select name="pekerjaan" class="form-control" required>
                @foreach(config('dropdowns.pekerjaan') as $pekerjaan)
                    <option value="{{ $pekerjaan }}" {{ isset($ktp) && $ktp->pekerjaan == $pekerjaan ? 'selected' : '' }}>{{ $pekerjaan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Kewarganegaraan -->
        <div class="mb-3">
            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
            <select name="kewarganegaraan" class="form-control" required>
                @foreach(config('dropdowns.kewarganegaraan') as $kewarganegaraan)
                    <option value="{{ $kewarganegaraan }}" {{ isset($ktp) && $ktp->kewarganegaraan == $kewarganegaraan ? 'selected' : '' }}>{{ $kewarganegaraan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Status Hubungan dalam Keluarga -->
        <div class="mb-3">
            <label for="status_hubungan_keluarga" class="form-label">Status Hubungan Dalam Keluarga</label>
            <select name="status_hubungan_keluarga" class="form-control" required>
                @foreach(config('dropdowns.status_hubungan_keluarga') as $status_hubungan)
                    <option value="{{ $status_hubungan }}" {{ isset($ktp) && $ktp->status_hubungan_keluarga == $status_hubungan ? 'selected' : '' }}>{{ $status_hubungan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="masa_berlaku" class="form-label">Masa Berlaku</label>
            <input type="date" name="masa_berlaku" class="form-control" value="{{ isset($ktp) ? $ktp->masa_berlaku : '' }}" required>
        </div>
        

        <div class="mb-3">
            <label for="dokumen_imigrasi" class="form-label">Dokumen Imigrasi (Opsional)</label>
            <input type="text" name="dokumen_imigrasi" class="form-control" value="{{ isset($ktp) ? $ktp->dokumen_imigrasi : '' }}">
        </div>

        <div class="mb-3">
            <label for="no_paspor" class="form-label">No. Paspor (Opsional)</label>
            <input type="text" name="no_paspor" class="form-control" value="{{ isset($ktp) ? $ktp->no_paspor : '' }}" oninput="validateNumber(this)">
        </div>

        <div class="mb-3">
            <label for="no_kitap" class="form-label">No. KITAP (Opsional)</label>
            <input type="text" name="no_kitap" class="form-control" value="{{ isset($ktp) ? $ktp->no_kitap : '' }}" oninput="validateNumber(this)">
        </div>

        <!-- Nama Ayah (Hanya Huruf) -->
        <div class="mb-3">
            <label for="nama_ayah" class="form-label">Nama Ayah</label>
            <input type="text" name="nama_ayah" class="form-control" value="{{ isset($ktp) ? $ktp->nama_ayah : '' }}" required>
        </div>

        <!-- Nama Ibu (Hanya Huruf) -->
        <div class="mb-3">
            <label for="nama_ibu" class="form-label">Nama Ibu</label>
            <input type="text" name="nama_ibu" class="form-control" value="{{ isset($ktp) ? $ktp->nama_ibu : '' }}" required>
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        // Fungsi untuk memastikan hanya angka yang bisa dimasukkan
        function validateNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }
    </script>
@endsection
