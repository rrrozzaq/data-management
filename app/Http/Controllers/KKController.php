<?php

namespace App\Http\Controllers;

use App\Models\KK;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KKController extends Controller
{
    // API: Mengembalikan semua data KK dalam format JSON
    public function apiIndex()
    {
        try {
            $kks = KK::all(); // Mengambil semua data KK
            return response()->json([
                'status' => 'success',
                'message' => 'Data Kartu Keluarga retrieved successfully',
                'data' => $kks
            ], 200); // Mengembalikan data sebagai JSON dengan status 200 OK
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving data'
            ], 500); // Internal Server Error
        }
    }

    // API: Menyimpan KK baru ke database dan mengembalikan JSON
    public function apiStore(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nomor_kk' => 'required|numeric|unique:kks,nomor_kk',
                'nama_kepala_keluarga' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'nik' => 'required|numeric|unique:kks,nik',
                'agama' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                'status_perkawinan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'kewarganegaraan' => 'required',
                'dokumen_imigrasi' => 'nullable|string|max:255',
            ], [
                // Custom error messages
                'nik.unique' => 'NIK yang Anda masukkan sudah terdaftar.',
                'nomor_kk.unique' => 'Nomor KK sudah digunakan, silakan periksa kembali.'
            ]);

            // Simpan data ke database
            $kk = KK::create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data Kartu Keluarga created successfully',
                'data' => $kk
            ], 201); // Status 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 400); // Bad Request
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating data'
            ], 500); // Internal Server Error
        }
    }

    // API: Mengembalikan detail KK dalam format JSON
    public function apiShow($id)
    {
        try {
            $kk = KK::with('ktps')->find($id); // Mengambil data KK beserta KTP yang terkait
            if (!$kk) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ], 404); // Not Found
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data Kartu Keluarga retrieved successfully',
                'data' => $kk
            ], 200); // Mengembalikan data sebagai JSON
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving data'
            ], 500); // Internal Server Error
        }
    }

    // API: Memperbarui data KK dan mengembalikan respons JSON
    public function apiUpdate(Request $request, $id)
    {
        try {
            // Cari data KK berdasarkan ID
            $kk = KK::find($id);

            // Jika data tidak ditemukan, kembalikan respons error
            if (!$kk) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data dengan ID ' . $id . ' tidak ditemukan'
                ], 404); // Not Found
            }

            // Validasi input dengan pesan error kustom
            $validatedData = $request->validate([
                'nomor_kk' => 'required|numeric|unique:kks,nomor_kk,' . $id,
                'nama_kepala_keluarga' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'nik' => 'required|numeric|unique:kks,nik,' . $id,
                'agama' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                'status_perkawinan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'kewarganegaraan' => 'required',
                'dokumen_imigrasi' => 'nullable|string|max:255',
            ], [
                // Pesan error kustom
                'nomor_kk.unique' => 'Nomor KK ini sudah terdaftar, silakan gunakan nomor KK yang berbeda.',
                'nik.unique' => 'NIK ini sudah terdaftar, silakan gunakan NIK yang berbeda.',
            ]);

            // Update data KK
            $kk->update($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data Kartu Keluarga berhasil diperbarui',
                'data' => $kk
            ], 200); // OK
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 400); // Bad Request
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data'
            ], 500); // Internal Server Error
        }
    }


    // API: Menghapus data KK dan mengembalikan respons JSON
    public function apiDestroy($id)
    {
        try {
            $kk = KK::find($id);
            if (!$kk) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ], 404); // Not Found
            }

            // Hapus data KK
            $kk->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Kartu Keluarga berhasil dihapus'
            ], 200); // OK
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting data'
            ], 500); // Internal Server Error
        }
    }

    // Web: Mengembalikan semua data KK dalam bentuk view
    public function index()
    {
        try {
            $kks = KK::all(); // Mengambil semua data KK
            return view('kk.index', compact('kks')); // Mengirim data ke view
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while retrieving data']);
        }
    }

    // Web: Menampilkan form untuk membuat KK baru
    public function create()
    {
        try {
            return view('kk.create');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while loading form']);
        }
    }

    // Web: Menyimpan KK baru ke database dan mengembalikan view
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nomor_kk' => 'required|numeric|unique:kks,nomor_kk',
                'nama_kepala_keluarga' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'nik' => 'required|numeric|unique:kks,nik',
                'agama' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                'status_perkawinan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'kewarganegaraan' => 'required',
                'dokumen_imigrasi' => 'nullable|string|max:255',
            ]);

            KK::create($validatedData);

            return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil disimpan.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while saving data']);
        }
    }

    // Web: Menampilkan detail dari sebuah KK (Show)
    public function show($id)
    {
        try {
            $kk = KK::with('ktps')->findOrFail($id);
            return view('kk.show', compact('kk'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while retrieving data']);
        }
    }

    // Web: Menampilkan form untuk mengedit data KK (Edit)
    public function edit($id)
    {
        try {
            $kk = KK::findOrFail($id);
            return view('kk.edit', compact('kk'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while loading form']);
        }
    }

    // Web: Memperbarui data KK di database dan mengembalikan view
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nomor_kk' => 'required|numeric|unique:kks,nomor_kk,' . $id,
                'nama_kepala_keluarga' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'nik' => 'required|numeric|unique:kks,nik,' . $id,
                'agama' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                'status_perkawinan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'kewarganegaraan' => 'required',
                'dokumen_imigrasi' => 'nullable|string|max:255',
            ]);

            $kk = KK::findOrFail($id);
            $kk->update($validatedData);

            return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil diperbarui.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while updating data']);
        }
    }

    // Web: Menghapus data KK dari database dan mengembalikan view
    public function destroy($id)
    {
        try {
            $kk = KK::findOrFail($id);
            $kk->delete();

            return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while deleting data']);
        }
    }

    // Web: Mengambil semua data KK beserta anggota keluarga (relasi KTP)
    public function daftarKartuKeluarga()
    {
        try {
            $kks = KK::with('ktps')->get();
            return view('kk.daftar', compact('kks'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while retrieving data']);
        }
    }
}
