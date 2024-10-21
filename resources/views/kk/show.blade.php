@extends('layouts.home')

@section('title', 'Detail Kartu Keluarga')

@section('content')
    <h1>Detail Kartu Keluarga</h1>

    <div class="mb-3">
        <strong>Nomor Kartu Keluarga:</strong>
        <p>{{ $kk->nomor_kk }}</p>
    </div>

    <div class="mb-3">
        <strong>Nama Kepala Keluarga:</strong>
        <p>{{ $kk->nama_kepala_keluarga }}</p>
    </div>

    <div class="mb-3">
        <strong>Alamat:</strong>
        <p>{{ $kk->alamat }}</p>
    </div>

    <div class="mb-3">
        <strong>Tempat Lahir:</strong>
        <p>{{ $kk->tempat_lahir }}</p>
    </div>

    <div class="mb-3">
        <strong>Tanggal Lahir:</strong>
        <p>{{ $kk->tanggal_lahir }}</p>
    </div>

    <div class="mb-3">
        <strong>Jenis Kelamin:</strong>
        <p>{{ $kk->jenis_kelamin }}</p>
    </div>

    <div class="mb-3">
        <strong>NIK:</strong>
        <p>{{ $kk->nik }}</p>
    </div>

    <div class="mb-3">
        <strong>Agama:</strong>
        <p>{{ $kk->agama }}</p>
    </div>

    <div class="mb-3">
        <strong>Pendidikan:</strong>
        <p>{{ $kk->pendidikan }}</p>
    </div>

    <div class="mb-3">
        <strong>Pekerjaan:</strong>
        <p>{{ $kk->pekerjaan }}</p>
    </div>

    <div class="mb-3">
        <strong>Status Perkawinan:</strong>
        <p>{{ $kk->status_perkawinan }}</p>
    </div>

    <div class="mb-3">
        <strong>Status Hubungan Keluarga:</strong>
        <p>{{ $kk->status_hubungan_keluarga }}</p>
    </div>

    <div class="mb-3">
        <strong>Kewarganegaraan:</strong>
        <p>{{ $kk->kewarganegaraan }}</p>
    </div>

    <div class="mb-3">
        <strong>Dokumen Imigrasi (Opsional):</strong>
        <p>{{ $kk->dokumen_imigrasi ?: 'Tidak Ada' }}</p>
    </div>

    <a href="{{ route('kk.edit', $kk->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('kk.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
@endsection
