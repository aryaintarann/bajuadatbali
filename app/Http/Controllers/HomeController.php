<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $konf = DB::table('setting')->first() ?? (object)['logo_setting' => null, 'nama_setting' => 'Baju Adat Bali'];
        $galeri = Galeri::all();
        $filterType = $request->input('filter', '*');

        $pakaian = DB::table('pakaian')->get();
        $layanans = DB::table('layanan')->get();

        // 🔥 ambil data berita
        $beritas = Berita::orderByDesc('created_at')->limit(6)->get();

        return view('welcome', compact(
            'pakaian',
            'konf',
            'galeri',
            'layanans',
            'filterType',
            'beritas'
        ));
    }


    public function kontak()
    {
        $konf = DB::table('setting')->first() ?? (object)['logo_setting' => null, 'nama_setting' => 'Baju Adat Bali'];
        return view('kontak', compact('konf'));
    }

    // cart() and addToCart() removed — handled by CartController

    public function detailpakaian($slug)
    {
        $konf = DB::table('setting')->first() ?? (object)['logo_setting' => null, 'nama_setting' => 'Baju Adat Bali'];
        // Use leftJoin so product still shows even if category is null
        // FK in pakaian table is 'kategori_pakaian_id' referencing 'id_kategori_pakaian'
        $tshirt = DB::table('pakaian')
            ->leftJoin('kategori_pakaians', 'pakaian.kategori_pakaian_id', '=', 'kategori_pakaians.id_kategori_pakaian')
            ->select('pakaian.*', 'kategori_pakaians.nama_kategori_pakaian as nama_kategori')
            ->where('slug_pakaian', $slug)
            ->first();

        if (!$tshirt) {
            abort(404);
        }

        $pakaian = DB::table('pakaian')->orderByDesc('id_pakaian')->limit(8)->get();
        return view('pakaian-details', compact('konf', 'tshirt', 'pakaian'));
    }

    public function detaillayanan($slug)
    {
        $konf = DB::table('setting')->first() ?? (object)['logo_setting' => null, 'nama_setting' => 'Baju Adat Bali'];
        $serv = Layanan::where('slug_layanan', $slug)->firstOrFail();
        $layanan = DB::table('layanan')->orderByDesc('id_layanan')->get();
        return view('layanan-details', compact('konf', 'layanan', 'serv'));
    }

    // checkout() removed — handled by CheckoutController

    public function detailBerita($slug)
    {
        $konf = DB::table('setting')->first() ?? (object)['logo_setting' => null, 'nama_setting' => 'Baju Adat Bali'];

        $berita = Berita::where('slug_berita', $slug)->firstOrFail();

        $beritaTerbaru = Berita::orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('beritas', compact('konf', 'berita', 'beritaTerbaru'));
    }
}
