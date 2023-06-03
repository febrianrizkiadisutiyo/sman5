<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class guruController extends Controller
{
    public function index(Request $request){
        $guru = Guru::all();
        return view('guru', compact('guru'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'nama_guru' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telefon'=> 'required', 
        ]);
        Guru::create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telefon' => $request->no_telefon,

        ]);
        // return redirect()->back()->with('status','student added Successfully');
        return redirect('/guru')->with('success','Berhasil menambahkan satuan Produk');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);

        return view('guru', compact('guru'));
    }
    public function update(Request $request, $id)
    {
        $siswa = Guru::find($id);
        $siswa->nama_guru = $request->input('nama_guru');
        $siswa->nip = $request->input('nip');
        $siswa->jenis_kelamin = $request->input('jenis_kelamin');
        $siswa->alamat = $request->input('alamat');
        $siswa->no_telefon = $request->input('no_telefon');
        $siswa->update();
        return redirect('/guru')->with('success','Berhasil mengedit data produk');
    }

    public function destroy($id)
    {
        $guru = Guru::find($id);
        $guru->Kelas()->delete();
        $guru->delete();
        return redirect()->back()->with('status','berhasil terhapus');
    }
}
