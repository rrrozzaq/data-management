<?php

namespace App\Http\Controllers;

use App\Models\KTP;
use App\Models\KK;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KTPController extends Controller
{
    // API: Mengembalikan semua data KTP dalam format JSON
    public function apiIndex()
    {
        try {
            $ktps = KTP::all(); // Mengambil semua data KTP
            return response()->json([
                'status' => 'success',
                'message' => 'Data KTP retrieved successfully',
                'data' => $ktps
            ], 200); // Mengembalikan data sebagai JSON
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving data'
            ], 500); // Internal Server Error
        }
    }

    // API: Menyimpan KTP baru ke database dan mengembalikan JSON
    public function apiStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nik' => 'required|unique:ktps,nik',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'dokumen_imigrasi' => 'nullable|string',
                'no_paspor' => 'nullable|numeric',
                'no_kitap' => 'nullable|numeric',
                'nama_ayah' => 'nullable|string',
                'nama_ibu' => 'nullable|string',
                'kewarganegaraan' => 'required',
                'masa_berlaku' => 'required|date',
                'kk_id' => 'required|exists:kks,id', // Validasi field KK ID
            ], [
                // Pesan error kustom
                'nik.unique' => 'NIK yang Anda masukkan sudah terdaftar.',
            ]);

            $ktp = KTP::create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data KTP created successfully',
                'data' => $ktp
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

    public function apiUpdate(Request $request, $id)
    {
        try {
            // Cari data KTP berdasarkan ID
            $ktp = KTP::find($id);

            // Jika data tidak ditemukan, kembalikan respons error
            if (!$ktp) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data dengan ID ' . $id . ' tidak ditemukan'
                ], 404); // Not Found
            }

            // Validasi input dengan pesan error kustom
            $validatedData = $request->validate([
                'nik' => 'required|numeric|unique:ktps,nik,' . $id,
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'dokumen_imigrasi' => 'nullable|string',
                'no_paspor' => 'nullable|numeric',
                'no_kitap' => 'nullable|numeric',
                'nama_ayah' => 'nullable|string',
                'nama_ibu' => 'nullable|string',
                'kewarganegaraan' => 'required',
                'masa_berlaku' => 'required|date',
                'kk_id' => 'required|exists:kks,id',
            ], [
                // Pesan error kustom
                'nik.unique' => 'Anda tidak bisa mengubah data ini. Silakan gunakan NIK yang berbeda.',
            ]);

            // Update data KTP
            $ktp->update($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data KTP berhasil diperbarui',
                'data' => $ktp
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

    public function apiShow($id)
    {
        try {
            // Cari data KTP berdasarkan ID
            $ktp = KTP::with('kk')->find($id);

            // Jika data tidak ditemukan
            if (!$ktp) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ], 404); // Not Found
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data KTP retrieved successfully',
                'data' => $ktp
            ], 200); // OK
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data'
            ], 500); // Internal Server Error
        }
    }

    public function apiDestroy($id)
    {
        try {
            // Cari data KTP berdasarkan ID
            $ktp = KTP::find($id);

            // Jika data tidak ditemukan
            if (!$ktp) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ], 404); // Not Found
            }

            // Hapus data KTP
            $ktp->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data KTP berhasil dihapus'
            ], 200); // OK
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data'
            ], 500); // Internal Server Error
        }
    }


    // Web: Mengembalikan semua data KTP dalam bentuk view
    public function index()
    {
        try {
            $ktps = KTP::all();
            return view('ktp.index', compact('ktps'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while retrieving data']);
        }
    }

    // Web: Menampilkan form untuk membuat KTP baru
    public function create()
    {
        try {
            $kks = KK::all(); // Mengambil semua data KK untuk dropdown
            return view('ktp.create', compact('kks'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while loading form']);
        }
    }

    // Web: Menyimpan KTP baru ke database dan mengembalikan view
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nik' => 'required|unique:ktps,nik',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'dokumen_imigrasi' => 'nullable|string',
                'no_paspor' => 'nullable|numeric',
                'no_kitap' => 'nullable|numeric',
                'nama_ayah' => 'nullable|string',
                'nama_ibu' => 'nullable|string',
                'kewarganegaraan' => 'required',
                'masa_berlaku' => 'required|date',
                'kk_id' => 'required|exists:kks,id',
            ]);

            KTP::create($validatedData);

            return redirect()->route('ktp.index')->with('success', 'Data KTP berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while saving data']);
        }
    }

    // Web: Menampilkan detail dari sebuah KTP (Show)
    public function show($id)
    {
        try {
            $ktp = KTP::findOrFail($id);
            return view('ktp.show', compact('ktp'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while retrieving data']);
        }
    }

    // Web: Menampilkan form untuk mengedit data KTP (Edit)
    public function edit($id)
    {
        try {
            $ktp = KTP::findOrFail($id);
            $kks = KK::all();
            return view('ktp.edit', compact('ktp', 'kks'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while loading form']);
        }
    }

    // Web: Memperbarui data KTP di database dan mengembalikan view
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nik' => 'required|numeric|unique:ktps,nik,' . $id,
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'status_hubungan_keluarga' => 'required',
                'dokumen_imigrasi' => 'nullable|string',
                'no_paspor' => 'nullable|numeric',
                'no_kitap' => 'nullable|numeric',
                'nama_ayah' => 'nullable|string',
                'nama_ibu' => 'nullable|string',
                'kewarganegaraan' => 'required',
                'masa_berlaku' => 'required|date',
                'kk_id' => 'required|exists:kks,id',
            ]);

            $ktp = KTP::findOrFail($id);
            $ktp->update($validatedData);

            return redirect()->route('ktp.index')->with('success', 'Data KTP berhasil diperbarui.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while updating data']);
        }
    }

    // Web: Menghapus data KTP dari database dan mengembalikan view
    public function destroy($id)
    {
        try {
            $ktp = KTP::findOrFail($id);
            $ktp->delete();

            return redirect()->route('ktp.index')->with('success', 'Data KTP berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'An error occurred while deleting data']);
        }
    }
}
