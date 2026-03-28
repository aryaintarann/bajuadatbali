@extends('layouts.index')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
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
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-2">
                            <label for="">Nama Galeri <abbr title="" style="color: black">*</abbr></label>
                            <input type="text" class="form-control" placeholder="Masukkan Judul Gambar disini...." name="nama_galeri" value="{{ old('nama_galeri') }}">
                        </div>
                        <div class="form-group mb-2">
                           
                            <label for="">Jenis Galeri</label>
                            <select name="jenis_galeri" id="dropdown" class="form-control">
                                <option value="Galeri" selected>Galeri</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Keterangan <abbr title="" style="color: black">*</abbr></label>
                            <input type="text" class="form-control" placeholder="Masukkan Keterangan disini...." name="keterangan_galeri" value="{{ old('keterangan_galeri') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Gambar <abbr title="" style="color: black">*</abbr> </label>
                            <input id="inputImg" type="file" accept="image/*" name="gambar_galeri" class="form-control">
                            <img class="d-none w-50 my-3 rounded shadow-sm" id="previewImg" src="#" alt="Preview image">
                        </div>

                        <!-- Area Crop -->
                        <div class="form-group p-3 border rounded mb-3" id="cropArea" style="display:none; background:#f8f9fa;">
                            <label class="font-weight-bold"><i class="fas fa-crop-alt"></i> Sesuaikan Ukuran Gambar</label>
                            <div class="mb-2">
                                <img id="imageToCrop" src="" style="max-width: 100%; max-height: 500px;">
                            </div>
                            <button type="button" class="btn btn-primary" id="btnCrop"><i class="fas fa-check"></i> Pangkas & Terapkan</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    var cropper;
    document.getElementById('inputImg').addEventListener('change', function(e) {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imageToCrop').src = e.target.result;
                document.getElementById('cropArea').style.display = 'block';
                document.getElementById('previewImg').classList.remove("d-block");
                document.getElementById('previewImg').classList.add("d-none");
                
                if (cropper) {
                    cropper.destroy();
                }
                
                // Inisialisasi cropper
                var image = document.getElementById('imageToCrop');
                cropper = new Cropper(image, {
                    aspectRatio: NaN, // Bebas ukuran
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    document.getElementById('btnCrop').addEventListener('click', function() {
        if (!cropper) return;
        
        // Ambil hasil pemangkasan
        cropper.getCroppedCanvas({
            maxWidth: 2000,
            maxHeight: 2000
        }).toBlob(function(blob) {
            // Tampilkan preview
            var url = URL.createObjectURL(blob);
            var previewImg = document.getElementById('previewImg');
            previewImg.src = url;
            previewImg.classList.remove('d-none');
            previewImg.classList.add('d-block');
            
            // Ganti file di input
            var file = new File([blob], "cropped-" + new Date().getTime() + ".jpg", { type: "image/jpeg", lastModified: new Date().getTime() });
            var container = new DataTransfer();
            container.items.add(file);
            document.getElementById('inputImg').files = container.files;

            // Sembunyikan area crop
            document.getElementById('cropArea').style.display = 'none';
        }, 'image/jpeg', 0.85);
    });
</script>

  <script>
      CKEDITOR.replace( 'editor', {
          filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token() ])}}",
          filebrowserUploadMethod: 'form'
      });
  </script>
@endsection