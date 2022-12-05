<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use App\Models\Kandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KandangController extends Controller
{
    public function index() {
        $datas = DB::select('SELECT * FROM bakul WHERE is_deleted = 0');

        return view('panen.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('kandang.add',compact('panen'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_kandang' => 'required',
            'nama_kandang' => 'required',
            'lokasi' => 'required',
            'spv' => 'required',
            'jenis_kandang' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO kandang(id_kandang, nama_kandang, lokasi, spv, jenis_kandang) 
        VALUES (:id_kandang, :nama_kandang, :lokasi, :spv, :jenis_kandang)',
        [
            'id_kandang' => $request->id_kandang,
            'nama_kandang' => $request->nama_kandang,
            'lokasi' => $request->lokasi,
            'spv' => $request->spv,
            'jenis_kandang' => $request->jenis_kandang,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('panen.index')->with('success', 'Data Kandang berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('kandang')->where('id_kandang', $id)->first();
        $panen = Panen::all();
        return view('kandang.edit')->with('data', $data, compact('panen'));
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_kandang' => 'required',
            'nama_kandang' => 'required',
            'lokasi' => 'required',
            'spv' => 'required',
            'jenis_kandang' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE panen SET id_bakul = :id_bakul, nama_bakul = :nama_bakul, jenis_bakul = : jenis_bakul 
        WHERE id_bakul = :id',
        [
            'id' => $id,
            'id_kandang' => $request->id_kandang,
            'nama_kandang' => $request->nama_kandang,
            'lokasi' => $request->lokasi,
            'spv' => $request->spv,
            'jenis_kandang' => $request->jenis_kandang,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('panen.index')->with('success', 'Data Kandang berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM kandang WHERE id_kandang = :id_kandang', ['id_kandang' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('panen.index')->with('success', 'Data Kandang berhasil dihapus');
    }

    public function softdelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE kandang SET is_deleted = 1
        WHERE id_kandang = :id_kandang', ['id_kandang' => $id]);
        return redirect()->route('panen.index')->with('success', 'Data Kandang berhasil dihapus');
    }

}
