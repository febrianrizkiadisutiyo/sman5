<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kelasController extends Controller
{
    public function index() {
        $guru = Guru::all();
        $allKelas = Kelas::with('Guru')->get();
         // dd($allKelas);
        $user_info = DB::table('siswas')
                    ->select('id_kelas', DB::raw('count(*) as jumlah_siswa'))
                    ->groupBy('id_kelas')
                    ->get();

        // dd($user_info);

         return view('kelas', [
            'kelas' => $allKelas,
            'jumlah' => $user_info,
            'guru' =>$guru
         ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kelas' => 'required',
            'id_guru' => 'required',
        ]);
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_guru' => $request->id_guru,
        ]);

        return redirect('/kelas')->with('success', 'Data Produk Berhasil Tersimpan');
    }

    public function edit($id)
    {
        $guru = Guru::all();
        $kelas = Kelas::with('Guru')->findOrFail($id);
        // return view('crudProduk.dataproduk',compact('produk','satuanProduk'));
        return view('kelas', compact('kelas', 'guru'));
    }
    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);
        $kelas->nama_kelas = $request->input('nama_kelas');
        $kelas->id_guru = $request->input('id_guru');
        $kelas->update();
        return redirect('/kelas')->with('success', 'Berhasil mengedit data produk');
    }
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->Siswa()->delete();
        $kelas->delete();
        return redirect()
            ->back()
            ->with('success', 'berhasil terhapus');
    }
}
