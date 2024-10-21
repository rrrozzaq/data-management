<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KTP extends Model
{
    use HasFactory;

    protected $table = 'ktps';  // Nama tabel di database

    protected $fillable = [
        'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
        'alamat', 'agama', 'status_perkawinan', 'pekerjaan', 
        'kewarganegaraan', 'masa_berlaku', 'status_hubungan_keluarga',
        'dokumen_imigrasi', 'no_paspor', 'no_kitap', 'nama_ayah', 'nama_ibu', 'kk_id'
    ];

    // Relasi Many-to-One dengan KK
    public function kk()
    {
        return $this->belongsTo(KK::class, 'kk_id');
    }
}
