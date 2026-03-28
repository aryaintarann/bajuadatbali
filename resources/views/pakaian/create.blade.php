@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('pakaian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="">Kategori Produk</label>
                            <select name="kategori_pakaian_id" id="dropdown" required>
                                <option value=""></option>
                                @foreach ($kategori_pakaian as $item)
                                    <option value="{{ $item->id_kategori_pakaian }}">{{ $item->nama_kategori_pakaian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group mb-2">
                            <label for=""> Nama Produk <abbr title="" style="color: black">*</abbr></label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Produk disini...."
                                name="nama_pakaian" value="{{ old('nama_pakaian') }}" required>
                        </div>



                        <div class="form-group mb-2">
                            <label for="">Deskripsi Pakaian</label>
                            <textarea name="pratinjau_pakaian" id="editor" cols="30" rows="10" class="form-control"
                                required>{{ old('pratinjau_pakaian') }}</textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for=""> Harga Produk <abbr title="" style="color: black">*</abbr></label>
                            <input type="number" class="form-control" placeholder="Masukkan Harga Produk disini...."
                                name="harga_pakaian" value="{{ old('harga_pakaian') }}" required>
                        </div>

                        {{-- Hapus Input Stok Global & Ganti dengan Stok Per Ukuran --}}
                        <div class="form-group mb-2">
                            <label>Stok Ukuran S</label>
                            <input type="number" class="form-control" name="stok_ukuran[S]" min="0" value="0" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Stok Ukuran M</label>
                            <input type="number" class="form-control" name="stok_ukuran[M]" min="0" value="0" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Stok Ukuran L</label>
                            <input type="number" class="form-control" name="stok_ukuran[L]" min="0" value="0" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Stok Ukuran XL</label>
                            <input type="number" class="form-control" name="stok_ukuran[XL]" min="0" value="0" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Stok Ukuran XXL</label>
                            <input type="number" class="form-control" name="stok_ukuran[XXL]" min="0" value="0" required>
                        </div>
                        <div class="form-group mb-2 text-primary">
                            <label><strong>Stok All Size (Satu Ukuran / Tidak ada ukuran spesifik)</strong></label>
                            <input type="number" class="form-control" name="stok_ukuran[All Size]" min="0" value="0"
                                required>
                        </div>


                        <!-- Bagian Ongkos Kirim yang akan disembunyikan -->
                        {{-- <div class="form-group mb-2" id="ongkirGroup">
                            <label for=""> Ongkos Kirim <abbr title="" style="color: black">*</abbr></label>
                            <input type="number" class="form-control" placeholder="Masukkan onkos kirim pakaian disini...."
                                name="ongkir" value="{{ old('ongkir') }}">
                        </div> --}}

                        <div class="form-group mb-2">
                            <label for="">Thumbnail Pakaian</label>
                            <input id="inputImg" type="file" accept="image/*" name="gambar_pakaian" class="form-control"
                                required />
                            <img class="d-none w-25 h-25 my-2" id="previewImg" src="#" alt="Preview image">
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('inputImg').addEventListener('change', function () {
            const fileInput = this;
            const previewImg = document.getElementById('previewImg');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                }
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                previewImg.classList.add('d-none');
            }
        });

        // Script untuk menyembunyikan Ongkos Kirim jika Type pakaian == 1
        document.getElementById('typeDropdown').addEventListener('change', function () {
            const selectedType = this.value;
            const ongkirGroup = document.getElementById('ongkirGroup');

            if (selectedType == 1) {
                ongkirGroup.style.display = 'none';
            } else {
                ongkirGroup.style.display = 'block';
            }
        });
    </script>

    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection