<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KK extends Model
{
    protected $table = 'kks';

    protected $fillable = [
        'nomor_kk', 'nama_kepala_keluarga', 'alamat', 'tempat_lahir', 
        'tanggal_lahir', 'jenis_kelamin', 'nik', 'agama', 'pendidikan',
        'pekerjaan', 'status_perkawinan', 'status_hubungan_keluarga',
        'kewarganegaraan', 'dokumen_imigrasi'
    ];

    public function ktps()
    {
        return $this->hasMany(KTP::class, 'kk_id');
    }
}
