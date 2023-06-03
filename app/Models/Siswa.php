<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nis','id_kelas','nama_siswa','jurusan','agama','tempat_lahir','tgl_lahir',
                            'jenis_kelamin','alamat'];
    public function Kelas(){
        return $this->belongsTo(Kelas::class,'id_kelas','id');
    }
}