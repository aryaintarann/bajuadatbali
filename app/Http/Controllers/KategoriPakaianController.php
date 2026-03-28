<?php

namespace App\Http\Controllers;

use App\Models\KategoriPakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriPakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kategori Produk';
        $kategoriPakaian = DB::table('kategori_pakaians')->get();
        return view('kategori_pakaian.index', compact('kategoriPakaian', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori Produk';
        return view('kategori_pakaian.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi!!!',
        ];
        $request->validate([
            'nama_kategori_pakaian' => 'required',

        ], $messages);

        $data = new KategoriPakaian();
        $data->nama_kategori_pakaian = $request->nama_kategori_pakaian;
        $data->save();
        return redirect()->route('kategori_pakaian.index')->with('Sukses', 'Berhasil Tambah Kategori Buku');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriPakaian $kategoriPakaian)
    {
        $title = 'Edit Kategori Produk';
        return view('kategori_pakaian.edit', compact('kategoriPakaian', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori_pakaian = KategoriPakaian::find($id);
        $update = [
            'nama_kategori_pakaian' => $request->nama_kategori_pakaian,

        ];
        $kategori_pakaian->update($update);
        return redirect()->route('kategori_pakaian.index')->with('Sukses', 'Berhasil Edit Kategori Produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori_pakaian = KategoriPakaian::find($id);
        $namagambarkategori_pakaian = $kategori_pakaian->gambar_kategori_pakaian;
        $gambar_kategori_pakaian = public_path('file/kategori_pakaian/') . $namagambarkategori_pakaian;
        if (file_exists($gambar_kategori_pakaian)) {
            @unlink($gambar_kategori_pakaian);
        }
        $kategori_pakaian->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Kategori Produk');
    }
}
