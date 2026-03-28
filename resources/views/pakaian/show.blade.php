@extends('layouts.index')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                @if ($pakaian)
                    <div class="card-header">
                        <a href="{{ Auth::user()->id == 1 ? route('pakaian.index') : route('pakaian.purchased') }}"
                            class="btn btn-warning" style="float: right;">
                            <i class="fas fa-eye"></i> Kembali
                        </a>
                        <h3>Detail Pakaian</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- Gambar -->
                            <div class="col-md-4">
                                <img src="{{ asset('file/pakaian/' . $pakaian->gambar_pakaian) }}"
                                    alt="{{ $pakaian->nama_pakaian }}" class="img-fluid">
                            </div>

                            <!-- Detail Pakaian -->
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $pakaian->nama_pakaian }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>Rp {{ number_format($pakaian->harga_pakaian, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td>
                                            @if ($pakaian->stok_pakaian > 0)
                                                <span class="badge badge-success">
                                                    {{ $pakaian->stok_pakaian }} tersedia
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Stok habis
                                                </span>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                        <th>Ongkir</th>
                                        <td>Rp {{ number_format($pakaian->ongkir, 0, ',', '.') }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{ $pakaian->nama_kategori_pakaian ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{!! $pakaian->pratinjau_pakaian !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
