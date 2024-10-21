@extends('layouts.home')

@section('title', 'Daftar Kartu Keluarga')
{{-- Menampilkan sidebar secara default --}}
@section('show_sidebar', true)
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Alamat</th>
                <th>Anggota Keluarga</th> <!-- Kolom untuk anggota keluarga -->
            </tr>
        </thead>
        <tbody>
            @foreach($kks as $kk)
                <tr>
                    <td>{{ $kk->nomor_kk }}</td>
                    <td>{{ $kk->nama_kepala_keluarga }}</td>
                    <td>{{ $kk->alamat }}</td>
                    <td>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Agama</th>
                                    <th>Pendidikan</th>
                                    <th>Pekerjaan</th>
                                    <th>Status Perkawinan</th>
                                    <th>Status Hubungan Dalam Keluarga</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Dokumen Imigrasi</th>
                                    <th>No. Paspor</th>
                                    <th>No. KITAP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kk->ktps as $ktp)
                                    <tr>
                                        <td>{{ $ktp->nama }}</td>
                                        <td>{{ $ktp->nik }}</td>
                                        <td>{{ $ktp->jenis_kelamin }}</td>
                                        <td>{{ $ktp->tempat_lahir }}</td>
                                        <td>{{ $ktp->tanggal_lahir }}</td>
                                        <td>{{ $ktp->agama }}</td>
                                        <td>{{ $ktp->pendidikan }}</td>
                                        <td>{{ $ktp->pekerjaan }}</td>
                                        <td>{{ $ktp->status_perkawinan }}</td>
                                        <td>{{ $ktp->status_hubungan_keluarga }}</td>
                                        <td>{{ $ktp->kewarganegaraan }}</td>
                                        <td>{{ $ktp->dokumen_imigrasi ?: '-' }}</td>
                                        <td>{{ $ktp->no_paspor ?: '-' }}</td>
                                        <td>{{ $ktp->no_kitap ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
