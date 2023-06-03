<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class siswaController extends Controller
{
    public function index() {
        $siswa = Siswa::with('Kelas')->get();
        // dd($siswa);
        $kelas = Kelas::all();
        return view('siswa', compact('siswa', 'kelas'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'nis' => 'required',
            'id_kelas' => 'required',
            'nama_siswa' => 'required',
            'jurusan' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);
        Siswa::create([
            'nis' => $request->nis,
            'id_kelas' => $request->id_kelas,
            'nama_siswa' => $request->nama_siswa,
            'jurusan' => $request->jurusan,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);
        
        return redirect('/siswa')->with('success', 'Data Produk Berhasil Tersimpan');
    }

    public function edit($id)
    {
        $kelas = Kelas::all();
        $siswa = Siswa::with('Kelas')->findOrFail($id);
        // return view('crudProduk.dataproduk',compact('produk','satuanProduk'));
        return view('kelas', compact('kelas','siswa'));
    }
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->nis = $request->input('nis');
        $siswa->id_kelas = $request->input('id_kelas');
        $siswa->nama_siswa = $request->input('nama_siswa');
        $siswa->agama = $request->input('agama');
        $siswa->tempat_lahir = $request->input('tempat_lahir');
        $siswa->tgl_lahir = $request->input('tgl_lahir');
        $siswa->jenis_kelamin = $request->input('jenis_kelamin');
        $siswa->alamat = $request->input('alamat');
        $siswa->update();
        return redirect('/siswa')->with('success','Berhasil mengedit data produk');
    }
    public function destroy($id)
    {  
            $siswa = Siswa::find($id);
            $siswa->delete();
            return redirect()->back()->with('success','berhasil terhapus');
    }
}
