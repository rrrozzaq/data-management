@extends('layouts.home')

@section('title', 'Home')

{{-- Menyembunyikan sidebar di Home Page --}}
@section('show_sidebar', false)

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="text-center">
            <h1>Selamat Datang di Data Management Penduduk</h1>
            <p>Kelola Data Kartu Keluarga (KK) dan Kartu Tanda Penduduk (KTP)</p>

            <p>
                Project ini ditujukan untuk <strong>recruitment test PT Efea Inovasi Solusi</strong> oleh <strong>Abdul Rozzaq</strong>
            </p>

            <p>
                <a href="{{ route('kk.index') }}" class="btn btn-primary">Kelola Data</a>
            </p>
        </div>
    </div>
@endsection
