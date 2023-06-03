<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";
    use HasFactory;

    protected $fillable = ['nama_kelas','id_guru'];

     public function Siswa(){
        return $this->hasMany(Siswa::class,'id_kelas','id');
    }
    public function Guru() {
        return $this->belongsTo(Guru::class,'id_guru','id');
    }
}
