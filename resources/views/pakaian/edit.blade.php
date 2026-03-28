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
                    <form action="{{ route('pakaian.update', $pakaian->id_pakaian) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Kategori Produk</label>
                            <select name="kategori_pakaian_id" id="dropdown">
                                <option value=""></option>
                                @foreach ($kategori_pakaian as $item)
                                    <option @if ($pakaian->kategori_pakaian_id == $item->id_kategori_pakaian) selected @endif
                                        value="{{ $item->id_kategori_pakaian }}">{{ $item->nama_kategori_pakaian }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Nama Produk <abbr title="" style="color: black">*</abbr></label>
                            <input required type="text" class="form-control" name="nama_pakaian"
                                value="{{ $pakaian->nama_pakaian }}">
                        </div>


                        <div class="form-group mb-2">
                            <label for="">Deskripsi Pakaian</label>
                            <textarea name="pratinjau_pakaian" id="editor" cols="30" rows="10"
                                class="form-control">{{ $pakaian->pratinjau_pakaian }}</textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Harga Produk <abbr title="" style="color: black">*</abbr></label>
                            <input required type="number" class="form-control" name="harga_pakaian"
                                value="{{ $pakaian->harga_pakaian }}">
                        </div>

                        {{-- Tabel Stok & Harga Per Ukuran --}}
                        <div class="form-group mb-2">
                            <label><strong>Stok &amp; Harga Per Ukuran</strong></label>
                            <small class="text-muted d-block mb-2">
                                Isi harga per ukuran. Jika harga ukuran diisi 0, akan menggunakan harga dasar.
                            </small>
                            <table class="table table-bordered table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width:20%">Ukuran</th>
                                        <th style="width:40%">Stok</th>
                                        <th style="width:40%">Harga (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(['S','M','L','XL','XXL','All Size'] as $ukuran)
                                    @php $sizeRow = $pakaian->sizes->where('ukuran', $ukuran)->first(); @endphp
                                    <tr>
                                        <td class="align-middle">
                                            <strong>{{ $ukuran }}</strong>
                                            @if($ukuran === 'All Size')
                                                <br><small class="text-primary">Satu ukuran</small>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number"
                                                class="form-control form-control-sm"
                                                name="stok_ukuran[{{ $ukuran }}]"
                                                min="0"
                                                value="{{ $sizeRow->stok ?? 0 }}" required>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number"
                                                    class="form-control form-control-sm"
                                                    name="harga_ukuran[{{ $ukuran }}]"
                                                    min="0"
                                                    value="{{ $sizeRow->harga ?? $pakaian->harga_pakaian }}"
                                                    placeholder="0 = pakai harga dasar">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{-- <div class="form-group mb-2" id="ongkir-section">
                            <label for="">Ongkos Kirim <abbr title="" style="color: black">*</abbr></label>
                            <input required type="number" class="form-control" name="ongkir" value="{{ $pakaian->ongkir }}">
                        </div> --}}

                        <div class="form-group mb-3">
                            <label for="">Gambar</label>
                            <input type="file" class="form-control" name="gambar_pakaian" placeholder="" accept="image/*"
                                id="preview_gambar" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Preview Gambar</label>
                            <img src="{{ asset('file/pakaian/' . $pakaian->gambar_pakaian) }}" alt="" style="width: 200px;"
                                id="gambar_nodin">
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
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{ route('image.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        // JavaScript to handle hiding/showing of the Ongkos Kirim section
        document.addEventListener('DOMContentLoaded', function () {
            const idTypeSelect = document.getElementById('id_type');
            const ongkirSection = document.getElementById('ongkir-section');
            const ongkirInput = document.querySelector('input[name="ongkir"]');

            // Function to toggle visibility of the Ongkos Kirim section
            function toggleOngkirSection() {
                if (idTypeSelect.value == '1') {
                    ongkirSection.style.display = 'none';
                    ongkirInput.removeAttribute('required'); // Remove required attribute when hidden
                    ongkirInput.value = ''; // Optionally clear the value when hidden
                } else {
                    ongkirSection.style.display = 'block';
                    ongkirInput.setAttribute('required', 'required'); // Add required attribute when shown
                }
            }

            // Initial check to set the visibility on page load
            toggleOngkirSection();

            // Event listener for when the type changes
            idTypeSelect.addEventListener('change', toggleOngkirSection);
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('image.upload') . '?_token=' . csrf_token() }}',
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{ route('image.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection