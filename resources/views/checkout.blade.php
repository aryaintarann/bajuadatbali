@extends('layouts.web')

@section('isi')

    <!-- Page Header -->
    <div class="page-header">
        <h1>Checkout</h1>
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <a href="{{ route('cart.index') }}">Keranjang</a>
            <span>/</span>
            <span>Checkout</span>
        </div>
    </div>

    <!-- Step Indicator -->
    <div class="container-fluid px-xl-5 mb-4">
        <div class="d-flex align-items-center justify-content-center" style="gap:0;">
            <div class="d-flex align-items-center">
                <div style="width:36px; height:36px; border-radius:50%; background:#eee; color:#999; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.85rem;">
                    <i class="fas fa-check"></i>
                </div>
                <span style="margin-left:8px; color:#999; font-size:0.85rem;">Keranjang</span>
            </div>
            <div style="width:60px; height:2px; background:#E8500A; margin:0 12px;"></div>
            <div class="d-flex align-items-center">
                <div style="width:36px; height:36px; border-radius:50%; background:#E8500A; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.85rem;">2</div>
                <span style="margin-left:8px; color:#E8500A; font-weight:600; font-size:0.85rem;">Checkout</span>
            </div>
            <div style="width:60px; height:2px; background:#eee; margin:0 12px;"></div>
            <div class="d-flex align-items-center">
                <div style="width:36px; height:36px; border-radius:50%; background:#eee; color:#999; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.85rem;">3</div>
                <span style="margin-left:8px; color:#999; font-size:0.85rem;">Pembayaran</span>
            </div>
        </div>
    </div>

    <div class="container-fluid px-xl-5 pb-5">
        <div class="row">

            <!-- Checkout Form -->
            <div class="col-lg-8 mb-5">
                <div class="card border-0 shadow-sm" style="border-radius:16px;">
                    <div class="card-header" style="background:linear-gradient(135deg,#E8500A,#c43d00); color:#fff; padding:18px 24px; border-radius:16px 16px 0 0; border:none;">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt mr-2"></i>Informasi Pengiriman</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('checkout.placeOrder') }}" method="POST" id="checkoutForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label style="font-weight:600; color:#444; font-size:0.9rem;">Nama Lengkap <span style="color:#E8500A;">*</span></label>
                                    <input name="nama" class="form-control" required
                                        style="border-radius:10px; border:2px solid #eee; padding:12px 16px; font-size:0.9rem;"
                                        placeholder="Masukkan nama lengkap">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label style="font-weight:600; color:#444; font-size:0.9rem;">No. Telepon <span style="color:#E8500A;">*</span></label>
                                    <input name="no_tlpn" class="form-control" required
                                        style="border-radius:10px; border:2px solid #eee; padding:12px 16px; font-size:0.9rem;"
                                        placeholder="Contoh: 08123456789">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label style="font-weight:600; color:#444; font-size:0.9rem;">Email <span style="color:#E8500A;">*</span></label>
                                    <input type="email" name="email" class="form-control" required
                                        style="border-radius:10px; border:2px solid #eee; padding:12px 16px; font-size:0.9rem;"
                                        placeholder="contoh@email.com">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label style="font-weight:600; color:#444; font-size:0.9rem;">Kota <span style="color:#E8500A;">*</span></label>
                                    <input name="kota" class="form-control" required
                                        style="border-radius:10px; border:2px solid #eee; padding:12px 16px; font-size:0.9rem;"
                                        placeholder="Nama kota">
                                </div>

                                <div class="col-md-12 form-group">
                                    <label style="font-weight:600; color:#444; font-size:0.9rem;">Alamat Lengkap <span style="color:#E8500A;">*</span></label>
                                    <input name="alamat" class="form-control" required
                                        style="border-radius:10px; border:2px solid #eee; padding:12px 16px; font-size:0.9rem;"
                                        placeholder="Jalan, nomor rumah, RT/RW, kelurahan, kecamatan">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label style="font-weight:600; color:#444; font-size:0.9rem;">Provinsi <span style="color:#E8500A;">*</span></label>
                                    <select name="provinsi" id="provinsi" class="form-control" required
                                        style="border-radius:10px; border:2px solid #eee; height: 50px; padding: 0 16px; font-size:0.9rem; appearance:none; background: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'16\' fill=\'%23E8500A\' viewBox=\'0 0 16 16\'><path d=\'M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z\'/></svg>') no-repeat right 16px center; background-size: 12px; background-color:#fff;">
                                        <option value="" disabled selected>-- Pilih Provinsi Tujuan Pengiriman --</option>
                                        <optgroup label="SUMATERA">
                                            <option value="Aceh">Aceh</option>
                                            <option value="Sumatera Utara">Sumatera Utara</option>
                                            <option value="Sumatera Barat">Sumatera Barat</option>
                                            <option value="Riau">Riau</option>
                                            <option value="Kepulauan Riau">Kepulauan Riau</option>
                                            <option value="Jambi">Jambi</option>
                                            <option value="Sumatera Selatan">Sumatera Selatan</option>
                                            <option value="Bengkulu">Bengkulu</option>
                                            <option value="Lampung">Lampung</option>
                                            <option value="Bangka Belitung">Bangka Belitung</option>
                                        </optgroup>
                                        <optgroup label="JAWA">
                                            <option value="DKI Jakarta">DKI Jakarta</option>
                                            <option value="Jawa Barat">Jawa Barat</option>
                                            <option value="Banten">Banten</option>
                                            <option value="Jawa Tengah">Jawa Tengah</option>
                                            <option value="DI Yogyakarta">DI Yogyakarta</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                        </optgroup>
                                        <optgroup label="BALI & NUSA TENGGARA">
                                            <option value="Bali">Bali</option>
                                            <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                            <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        </optgroup>
                                        <optgroup label="KALIMANTAN">
                                            <option value="Kalimantan Barat">Kalimantan Barat</option>
                                            <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                            <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                            <option value="Kalimantan Timur">Kalimantan Timur</option>
                                            <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        </optgroup>
                                        <optgroup label="SULAWESI">
                                            <option value="Sulawesi Utara">Sulawesi Utara</option>
                                            <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                            <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                            <option value="Gorontalo">Gorontalo</option>
                                            <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        </optgroup>
                                        <optgroup label="MALUKU & PAPUA">
                                            <option value="Maluku">Maluku</option>
                                            <option value="Maluku Utara">Maluku Utara</option>
                                            <option value="Papua">Papua</option>
                                            <option value="Papua Barat">Papua Barat</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label style="font-weight:600; color:#444; font-size:0.9rem;">Kode POS <span style="color:#E8500A;">*</span></label>
                                    <input name="kode_pos" class="form-control" required
                                        style="border-radius:10px; border:2px solid #eee; padding:12px 16px; font-size:0.9rem;"
                                        placeholder="Contoh: 80361">
                                </div>
                            </div>

                            <hr style="border-color:#f0f0f0; margin:20px 0;">

                            <!-- Variasi Ukuran Dipilih di Keranjang -->

                            <!-- Payment Method -->
                            <h6 style="font-weight:700; color:#333; margin-bottom:16px;">Metode Pembayaran</h6>
                            <label class="d-flex align-items-center p-3 mb-2"
                                style="border:2px solid #E8500A; border-radius:12px; cursor:pointer; background:#fff0ec;">
                                <input type="radio" name="metode_pembayaran" value="midtrans" required style="margin-right:12px; accent-color:#E8500A;">
                                <div class="d-flex align-items-center">
                                    <div style="width:40px; height:40px; border-radius:8px; background:#E8500A; display:flex; align-items:center; justify-content:center; margin-right:12px;">
                                        <i class="fas fa-credit-card" style="color:#fff; font-size:1rem;"></i>
                                    </div>
                                    <div>
                                        <p style="font-weight:600; color:#333; margin:0; font-size:0.9rem;">Midtrans</p>
                                        <small style="color:#666;">Transfer Bank, GoPay, OVO, QRIS, Kartu Kredit</small>
                                    </div>
                                </div>
                            </label>

                            <button type="submit" class="btn btn-primary btn-block mt-4 py-3" style="font-size:1rem; font-weight:600;">
                                <i class="fas fa-lock mr-2"></i>Buat Pesanan & Bayar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4 mb-5">
                <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden; position:sticky; top:90px;">
                    <div class="card-header" style="background:linear-gradient(135deg,#E8500A,#c43d00); color:#fff; padding:18px 24px; border:none;">
                        <h5 class="mb-0"><i class="fas fa-receipt mr-2"></i>Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body p-4">

                        @foreach ($cart as $item)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center" style="gap:10px;">
                                    <img src="{{ asset('file/pakaian/' . $item['gambar']) }}"
                                        style="width:40px; height:40px; object-fit:cover; border-radius:8px;">
                                    <div>
                                        <p style="font-size:0.85rem; font-weight:500; color:#333; margin:0; line-height:1.3;">{{ $item['nama'] }}</p>
                                        @if(isset($item['ukuran']))
                                            <small class="badge bg-secondary px-1" style="font-size:0.65rem;">{{ $item['ukuran'] }}</small>
                                        @endif
                                        <small style="color:#999; margin-left:4px;">x{{ $item['quantity'] }}</small>
                                    </div>
                                </div>
                                <span style="font-weight:600; font-size:0.85rem; color:#333; white-space:nowrap;">Rp {{ number_format($item['harga'] * $item['quantity']) }}</span>
                            </div>
                        @endforeach

                        <hr style="border-color:#f0f0f0;">

                        <div class="d-flex justify-content-between mb-2">
                            <span style="color:#666; font-size:0.9rem;">Subtotal</span>
                            <span style="font-weight:600;" id="subtotal">Rp {{ number_format($subtotal) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span style="color:#666; font-size:0.9rem;">Ongkos Kirim</span>
                            <span style="font-weight:600; color:#E8500A;" id="ongkir">Rp 0</span>
                        </div>

                        <hr style="border-color:#f0f0f0;">

                        <div class="d-flex justify-content-between">
                            <span style="font-weight:700; font-size:1rem;">Total</span>
                            <span style="font-weight:700; font-size:1.1rem; color:#E8500A;" id="total">Rp {{ number_format($subtotal) }}</span>
                        </div>

                        <div class="mt-4 p-3" style="background:#fdf8f4; border-radius:10px;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt" style="color:#E8500A; margin-right:10px;"></i>
                                <small style="color:#666; font-size:0.8rem;">Pembayaran aman & terenkripsi melalui Midtrans</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@push('scripts')
<script>
    const ongkirProvinsi = {
        "Aceh": 30000, "Sumatera Utara": 28000, "Sumatera Barat": 28000,
        "Riau": 27000, "Kepulauan Riau": 30000, "Jambi": 27000,
        "Sumatera Selatan": 26000, "Bengkulu": 28000, "Lampung": 25000,
        "Bangka Belitung": 30000, "DKI Jakarta": 10000, "Jawa Barat": 12000,
        "Banten": 12000, "Jawa Tengah": 15000, "DI Yogyakarta": 15000,
        "Jawa Timur": 18000, "Bali": 20000, "Nusa Tenggara Barat": 30000,
        "Nusa Tenggara Timur": 40000, "Kalimantan Barat": 35000,
        "Kalimantan Tengah": 35000, "Kalimantan Selatan": 35000,
        "Kalimantan Timur": 38000, "Kalimantan Utara": 40000,
        "Sulawesi Utara": 40000, "Sulawesi Tengah": 40000,
        "Sulawesi Selatan": 38000, "Sulawesi Tenggara": 40000,
        "Gorontalo": 40000, "Sulawesi Barat": 40000,
        "Maluku": 45000, "Maluku Utara": 45000,
        "Papua": 60000, "Papua Barat": 55000
    };

    const subtotal = {{ $subtotal }};

    document.getElementById('provinsi').addEventListener('change', function() {
        const provinsi = this.value;
        const ongkir = ongkirProvinsi[provinsi] ?? 0;
        const total = subtotal + ongkir;

        document.getElementById('ongkir').innerText = 'Rp ' + ongkir.toLocaleString('id-ID');
        document.getElementById('total').innerText = 'Rp ' + total.toLocaleString('id-ID');
    });
</script>
@endpush

@endsection
