<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use App\Models\KategoriPakaian;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Produk';
        // Query pakaian
        $pakaian = DB::table('pakaian')->get();
        return view('pakaian.index', compact('title', 'pakaian'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_pakaian = KategoriPakaian::all();
        $pakaian = Pakaian::all();
        $title = 'Tambah Data Produk';
        return view('pakaian.create', compact('pakaian', 'title', 'kategori_pakaian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_pakaian_id' => 'required',
            'nama_pakaian' => 'required',
            'harga_pakaian' => 'required',
            'stok_ukuran' => 'required|array', // ✅ Validate size array
            'pratinjau_pakaian' => 'required',
            'gambar_pakaian' => 'required|image|max:2048',
        ]);


        $gambar_pakaian = $request->file('gambar_pakaian');
        $namafilepakaian = 'pakaian' . date('Ymdhis') . '.' . $gambar_pakaian->getClientOriginalExtension();
        $gambar_pakaian->move(public_path('file/pakaian'), $namafilepakaian); // ✅ gunakan public_path

        $pakaian = new Pakaian();
        $pakaian->kategori_pakaian_id = $request->kategori_pakaian_id;

        $pakaian->nama_pakaian = $request->nama_pakaian;
        $pakaian->harga_pakaian = $request->harga_pakaian;
        $pakaian->pratinjau_pakaian = $request->pratinjau_pakaian;

        $pakaian->gambar_pakaian = $namafilepakaian;
        $pakaian->slug_pakaian = Str::slug($request->nama_pakaian);

        // Calculate total stock from sizes
        $totalStok = 0;
        foreach ($request->stok_ukuran as $ukuran => $stok) {
            $totalStok += (int) $stok;
        }
        $pakaian->stok_pakaian = $totalStok; // ✅ Simpan total stok
        $pakaian->butuh_ukuran = $totalStok > 0 ? true : false;

        $pakaian->save();

        // Save sizes to DB
        foreach ($request->stok_ukuran as $ukuran => $stok) {
            \App\Models\PakaianSize::create([
                'pakaian_id' => $pakaian->id_pakaian,
                'ukuran' => $ukuran,
                'stok' => (int) $stok
            ]);
        }

        return redirect()->route('pakaian.index')->with('Sukses', 'Berhasil Tambah Pakaian');
    }



    /**
     * Display the specified resource.
     */

    public function show($id)
    {

        $pakaian = DB::table('pakaian')
            ->join('kategori_pakaians', 'pakaian.kategori_pakaian_id', '=', 'kategori_pakaians.id_kategori_pakaian')

            ->where('id_pakaian', $id)
            ->first();
        $title = 'Detail Data Produk';
        return view('pakaian.show', compact('title', 'pakaian'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pakaian = Pakaian::find($id);
        $kategori_pakaian = KategoriPakaian::all();

        $title = 'Edit Produk';
        return view('pakaian.edit', compact('title', 'kategori_pakaian', 'pakaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pakaian = Pakaian::find($id);

        $request->validate([
            'kategori_pakaian_id' => 'required',
            'stok_ukuran'         => 'required|array',
            'nama_pakaian'        => 'required',
            'harga_pakaian'       => 'required',
            'pratinjau_pakaian'   => 'required',
        ]);

        // Proses upload gambar
        $namafilepakaian = $pakaian->gambar_pakaian;
        if ($request->hasFile('gambar_pakaian')) {
            $gambar_pakaian = $request->file('gambar_pakaian');
            $namafilepakaian = 'pakaian' . date('Ymdhis') . '.' . $gambar_pakaian->getClientOriginalExtension();
            $gambar_pakaian->move(public_path('file/pakaian'), $namafilepakaian);
        }


        // Calculate total stock from sizes
        $totalStok = 0;
        foreach ($request->stok_ukuran as $ukuran => $stok) {
            $totalStok += (int) $stok;
        }

        // Update data produk
        $pakaian->update([
            'kategori_pakaian_id' => $request->kategori_pakaian_id,
            'nama_pakaian' => $request->nama_pakaian,
            'harga_pakaian' => $request->harga_pakaian,
            'stok_pakaian' => $totalStok, // ✅
            'pratinjau_pakaian' => $request->pratinjau_pakaian,

            'gambar_pakaian' => $namafilepakaian,
            'slug_pakaian' => Str::slug($request->nama_pakaian),
            'butuh_ukuran' => $totalStok > 0 ? true : false,
        ]);

        // Update or Create sizes in DB
        foreach ($request->stok_ukuran as $ukuran => $stok) {
            \App\Models\PakaianSize::updateOrCreate(
                ['pakaian_id' => $pakaian->id_pakaian, 'ukuran' => $ukuran],
                ['stok' => (int) $stok]
            );
        }


        return redirect()->route('pakaian.index')->with('Sukses', 'Berhasil Edit Produk');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pakaian = Pakaian::find($id);
        $namafilepakaian = $pakaian->gambar_pakaian;
        $file_ppakaian = public_path('file/pakaian/') . $namafilepakaian;
        if (file_exists($file_ppakaian)) {
            @unlink($file_ppakaian);
        }
        $pakaian->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Pakaian');
    }

    // Method purchasedBooks() dan updateLastPdfPage() dihapus (warisan sistem buku lama)

    public function cari(Request $request)
    {
        $query = $request->input('q');

        $pakaian = Pakaian::where('nama_pakaian', 'like', '%' . $query . '%')->get();

        return view('hasil_pencarian', compact('pakaian', 'query'));
    }
}
