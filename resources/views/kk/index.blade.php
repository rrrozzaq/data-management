@extends('layouts.home')

@section('title', 'Data Kartu Keluarga')

{{-- Menampilkan sidebar secara default --}}
@section('show_sidebar', true)

@section('content')
    <a href="{{ route('kk.create') }}" class="btn btn-primary mb-3">Tambah Kartu Keluarga</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>NIK Kepala Keluarga</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Status Perkawinan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kks as $kk)
                <tr>
                    <td>{{ $kk->nomor_kk }}</td>
                    <td>{{ $kk->nama_kepala_keluarga }}</td>
                    <td>{{ $kk->nik }}</td>
                    <td>{{ $kk->jenis_kelamin }}</td>
                    <td>{{ $kk->alamat }}</td>
                    <td>{{ $kk->status_perkawinan }}</td>
                    <td>
                        <a href="{{ route('kk.show', $kk->id) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('kk.edit', $kk->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('kk.destroy', $kk->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
