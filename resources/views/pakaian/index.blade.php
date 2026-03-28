@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('pakaian.create') }}" class="btn btn-dark btn-sm" style="float: right;"><i
                            class="fas fa-plus">Tambah</i></a>
                </div>
                <div class="card-body table table-responsive">



                    @if ($message = Session::get('Sukses'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-bordered" id="example3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>

                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga Produk</th>
                                <th scope="col">Stok Produk</th>
                                <th scope="col">Gambar Produk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pakaian as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $row->nama_pakaian }} </td>
                                    <td>Rp. {{ number_format($row->harga_pakaian) }}</td>
                                    <td>{{ $row->stok_pakaian }}</td>
                                    <td><img src="{{ asset('file/pakaian/' . $row->gambar_pakaian) }}"
                                            alt="{{ $row->nama_pakaian }}" class="img-fluid" style="width: 100px;"></td>
                                    @if (Auth::user()->id == 1)
                                        <td>
                                            <a href="{{ route('pakaian.show', $row->id_pakaian) }}" class="btn btn-warning btn-xs"
                                                style="display: inline-block"> <i class="fas fa-eye"> Show</i></a>
                                            <a href="{{ route('pakaian.edit', $row->id_pakaian) }}" class="btn btn-primary btn-xs"
                                                style="display: inline-block"><i class="fas fa-edit">Edit</i></a>
                                            <form action="{{ route('pakaian.destroy', $row->id_pakaian) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs btn-flat show_confirm"><i
                                                        class="fas fa-trash">Delete</i></button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('pakaian.show', $row->id_pakaian) }}" class="btn btn-warning btn-xs"
                                                style="display: inline-block"> <i class="fas fa-eye"> Mulai Membaca</i></a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection