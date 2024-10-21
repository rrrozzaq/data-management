@extends('layouts.home')

@section('title', 'Daftar Kartu Tanda Penduduk')
{{-- Menampilkan sidebar secara default --}}
@section('show_sidebar', true)
@section('content')
    <a href="{{ route('ktp.create') }}" class="btn btn-primary mb-3">Tambah KTP Baru</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ktps as $ktp)
                <tr>
                    <td>{{ $ktp->nik }}</td>
                    <td>{{ $ktp->nama }}</td>
                    <td>{{ $ktp->tempat_lahir }}</td>
                    <td>{{ $ktp->tanggal_lahir }}</td>
                    <td>{{ $ktp->jenis_kelamin }}</td>
                    <td>{{ $ktp->alamat }}</td>
                    <td>
                        <a href="{{ route('ktp.show', $ktp->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('ktp.edit', $ktp->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('ktp.destroy', $ktp->id) }}" method="POST" style="display:inline-block;">
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
