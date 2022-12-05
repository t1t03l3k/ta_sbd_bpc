<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use App\Models\Bakul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BakulController extends Controller
{
    public function index() {
        $datas = DB::select('SELECT * FROM bakul WHERE is_deleted = 0');

        return view('panen.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('bakul.add',compact('panen'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_bakul' => 'required',
            'nama_bakul' => 'required',
            'jenis_bakul' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO panen(id_bakul, nama_bakul, jenis_bakul) VALUES (:id_bakul, :nama_bakul, :jenis_bakul)',
        [
            'id_bakul' => $request->id_bakul,
            'nama_bakul' => $request->nama_bakul,
            'jenis_bakul' => $request->jenis_bakul,
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

        return redirect()->route('panen.index')->with('success', 'Data Bakul berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('bakul')->where('id_bakul', $id)->first();
        $panen = Panen::all();
        return view('bakul.edit')->with('data', $data, compact('panen'));
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_bakul' => 'required',
            'nama_bakul' => 'required',
            'jenis_bakul' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE panen SET id_bakul = :id_bakul, nama_bakul = :nama_bakul, jenis_bakul = :jenis_bakul 
        WHERE id_bakul = :id',
        [
            'id' => $id,
            'id_bakul' => $request->id_bakul,
            'nama_bakul' => $request->nama_bakul,
            'jenis_bakul' => $request->jenis_bakul,
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

        return redirect()->route('panen.index')->with('success', 'Data Bakul berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM bakul WHERE id_bakul = :id_bakul', ['id_bakul' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('panen.index')->with('success', 'Data Bakul berhasil dihapus');
    }

    public function softdelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE bakul SET is_deleted = 1
        WHERE id_bakul = :id_bakul', ['id_bakul' => $id]);
        return redirect()->route('panen.index')->with('success', 'Data Bakul berhasil dihapus');
    }

}
