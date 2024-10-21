@extends('layouts.home')

@section('title', 'Detail KTP')

@section('content')
    <h1>Detail KTP</h1>

    <div class="mb-3">
        <strong>NIK:</strong> {{ $ktp->nik }}
    </div>

    <div class="mb-3">
        <strong>Nama:</strong> {{ $ktp->nama }}
    </div>

    <div class="mb-3">
        <strong>Tempat, Tanggal Lahir:</strong> {{ $ktp->tempat_lahir }}, {{ $ktp->tanggal_lahir }}
    </div>

    <div class="mb-3">
        <strong>Jenis Kelamin:</strong> {{ $ktp->jenis_kelamin }}
    </div>

    <div class="mb-3">
        <strong>Alamat:</strong> {{ $ktp->alamat }}
    </div>

    <div class="mb-3">
        <strong>Agama:</strong> {{ $ktp->agama }}
    </div>

    <div class="mb-3">
        <strong>Status Perkawinan:</strong> {{ $ktp->status_perkawinan }}
    </div>

    <div class="mb-3">
        <strong>Pekerjaan:</strong> {{ $ktp->pekerjaan }}
    </div>

    <div class="mb-3">
        <strong>Kewarganegaraan:</strong> {{ $ktp->kewarganegaraan }}
    </div>

    <div class="mb-3">
        <strong>Masa Berlaku KTP:</strong> {{ $ktp->masa_berlaku }}
    </div>

    <a href="{{ route('ktp.edit', $ktp->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('ktp.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
