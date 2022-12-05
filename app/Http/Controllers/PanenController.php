<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use App\Models\Bakul;
use App\Models\Kandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PanenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $katakunci = $request->katakunci;
        if (strlen($katakunci)) {
            $datas = DB::table('panen')
                ->where('ekor', 'like', "%$katakunci%")
                ->orWhere('kg', 'like', "%$katakunci%")
                ->paginate(5);
        } else {
            $datas = DB::select('SELECT * FROM panen WHERE is_deleted = 0');
        }
        if (strlen($katakunci)) {
            $bakul = DB::table('bakul')
                ->where('nama_bakul', 'like', "%$katakunci%")
                ->orWhere('jenis_bakul', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $bakul = DB::select('SELECT * FROM bakul WHERE is_deleted = 0');
        }
        if (strlen($katakunci)) {
            $kandang = DB::table('kandang')
                ->where('nama_kandang', 'like', "%$katakunci%")
                ->orWhere('spv', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $kandang = DB::select('SELECT * FROM kandang WHERE is_deleted = 0');
        }
        
        $joins = DB::table('bakul')
            ->join('panen', 'panen.id_bakul', '=', 'bakul.id_bakul')
            ->select('bakul.nama_bakul', 'bakul.jenis_bakul', 'panen.ekor', 'panen.kg')
            ->get();
        $joins2 = DB::table('kandang')
            ->join('panen', 'kandang.id_kandang', '=', 'panen.id_kandang')
            ->select('kandang.nama_kandang', 'kandang.lokasi', 'kandang.spv', 'kandang.jenis_kandang', 'panen.ekor', 'panen.kg')
            ->get();
        return view('panen.index')
            ->with('datas', $datas)
            ->with('bakul', $bakul)
            ->with('kandang', $kandang)
            ->with('joins',$joins)
            ->with('joins2',$joins2);
    }

    public function create() {
        return view('panen.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_panen' => 'required',
            'id_bakul' => 'required',
            'id_kandang' => 'required',
            'ekor' => 'required',
            'kg' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO panen(id_panen, id_bakul, id_kandang, ekor, kg) VALUES (:id_panen, :id_bakul, :id_kandang, :ekor, :kg)',
        [
            'id_panen' => $request->id_panen,
            'id_bakul' => $request->id_bakul,
            'id_kandang' => $request->id_kandang,
            'ekor' => $request->ekor,
            'kg' => $request->kg,
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

        return redirect()->route('panen.index')->with('success', 'Data Panen berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('panen')->where('id_panen', $id)->first();

        return view('panen.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_panen' => 'required',
            'id_bakul' => 'required',
            'id_kandang' => 'required',
            'ekor' => 'required',
            'kg' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE panen SET id_panen = :id_panen, id_bakul = :id_bakul, id_kandang = :id_kandang, ekor = :ekor, kg = :kg 
        WHERE id_panen = :id',
        [
            'id' => $id,
            'id_panen' => $request->id_panen,
            'id_bakul' => $request->id_bakul,
            'id_kandang' => $request->id_kandang,
            'ekor' => $request->ekor,
            'kg' => $request->kg,
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

        return redirect()->route('panen.index')->with('success', 'Data Panen berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM panen WHERE id_panen = :id_panen', ['id_panen' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('panen.index')->with('success', 'Data Panen berhasil dihapus');
    }

    public function softdelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE panen SET is_deleted = 1
        WHERE id_panen = :id_panen', ['id_panen' => $id]);
        return redirect()->route('panen.index')->with('success', 'Data Panen berhasil dihapus');
    }

}