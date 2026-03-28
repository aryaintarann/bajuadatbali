@extends('layouts.web')

@section('isi')

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-undo mr-3"></i>Ajukan Refund</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span> Ajukan Refund
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            {{-- SUCCESS --}}
            @if(session('success'))
            <div class="alert alert-success" style="border-radius:14px;">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            @endif

            <!-- Info Box -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius:16px; border-left:4px solid #dc3545 !important; background:#fff5f5;">
                <div class="card-body d-flex align-items-start gap-3 py-3 px-4">
                    <i class="fas fa-info-circle mt-1" style="color:#dc3545; font-size:1.3rem; flex-shrink:0;"></i>
                    <div style="font-size:0.88rem; color:#555; line-height:1.7;">
                        <strong>Syarat Pengajuan Refund:</strong>
                        <ul class="mb-0 mt-1 pl-3">
                            <li>Pesanan sudah dibayar (status <em>paid</em>)</li>
                            <li>Belum pernah mengajukan refund untuk pesanan yang sama</li>
                            <li>Masukkan nomor pesanan dan email yang sesuai dengan saat checkout</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Refund Form -->
            <div class="card border-0 shadow-sm" style="border-radius:20px;">
                <div class="card-header border-0 py-4 px-4" style="background:linear-gradient(135deg,#dc3545,#b02a37); border-radius:20px 20px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight:600;">
                        <i class="fas fa-undo mr-2"></i>Form Pengajuan Refund
                    </h5>
                </div>
                <div class="card-body p-4">

                    @if($errors->any())
                    <div class="alert alert-danger" style="border-radius:12px;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-1 pl-3">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('refund.request') }}" method="POST">
                        @csrf

                        {{-- IDENTITAS PESANAN --}}
                        <h6 style="font-weight:700; color:#555; margin-bottom:1rem; text-transform:uppercase; font-size:0.78rem; letter-spacing:1px;">
                            Identitas Pesanan
                        </h6>

                        <div class="form-group mb-3">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Nomor Pesanan</label>
                            <input type="text" name="order_id" class="form-control @error('order_id') is-invalid @enderror"
                                placeholder="Contoh: ORDER-ABC123-..." value="{{ old('order_id') }}"
                                style="border-radius:10px;">
                            @error('order_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Nomor pesanan dikirim ke email Anda setelah pembayaran berhasil.</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email yang digunakan saat checkout" value="{{ old('email') }}"
                                style="border-radius:10px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="border-color:#f0f0f0; margin:1.5rem 0;">

                        {{-- ALASAN REFUND --}}
                        <h6 style="font-weight:700; color:#555; margin-bottom:1rem; text-transform:uppercase; font-size:0.78rem; letter-spacing:1px;">
                            Alasan Refund
                        </h6>

                        <div class="form-group mb-4">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Alasan Pengajuan Refund</label>
                            <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror"
                                rows="4" placeholder="Jelaskan alasan Anda mengajukan refund (min. 10 karakter)..."
                                style="border-radius:10px;">{{ old('alasan') }}</textarea>
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="border-color:#f0f0f0; margin:1.5rem 0;">

                        {{-- DATA REKENING --}}
                        <h6 style="font-weight:700; color:#555; margin-bottom:1rem; text-transform:uppercase; font-size:0.78rem; letter-spacing:1px;">
                            Data Rekening Pengembalian Dana
                        </h6>

                        <div class="form-group mb-3">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Bank</label>
                            <select name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" style="border-radius:10px;">
                                <option value="">-- Pilih Bank --</option>
                                @foreach(['BCA', 'Mandiri', 'BRI', 'BNI'] as $bank)
                                    <option value="{{ $bank }}" {{ old('nama_bank') == $bank ? 'selected' : '' }}>{{ $bank }}</option>
                                @endforeach
                            </select>
                            @error('nama_bank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Nama Pemilik Rekening</label>
                            <input type="text" name="nama_rekening" class="form-control @error('nama_rekening') is-invalid @enderror"
                                placeholder="Sesuai dengan buku tabungan" value="{{ old('nama_rekening') }}"
                                style="border-radius:10px;">
                            @error('nama_rekening')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" style="font-weight:600; font-size:0.9rem;">Nomor Rekening</label>
                            <input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror"
                                placeholder="Nomor rekening (10-20 digit)" value="{{ old('nomor_rekening') }}"
                                style="border-radius:10px;">
                            @error('nomor_rekening')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger btn-block"
                            style="border-radius:10px; padding:12px; font-weight:600; font-size:1rem;">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pengajuan Refund
                        </button>

                    </form>
                </div>
            </div>

            <!-- Link ke Cek Pesanan -->
            <div class="text-center mt-4">
                <a href="{{ route('order.tracking') }}" class="text-muted" style="font-size:0.9rem;">
                    <i class="fas fa-search mr-1"></i>Cek Status Pesanan terlebih dahulu
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
