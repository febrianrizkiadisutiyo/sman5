<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = "guru";
    use HasFactory;

    protected $fillable = ['nip','nama_guru','jenis_kelamin','alamat','no_telefon'];

    public function Kelas() {
        return $this->hasMany(Kelas::class, 'id_guru', 'id');
    }
}
