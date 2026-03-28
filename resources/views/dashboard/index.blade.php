@extends('layouts.index')

@section('content')
<div class="container-fluid py-3">

    {{-- ===== SUMMARY CARDS ===== --}}
    <div class="row">

        {{-- Total Pesanan --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPesanan }}</h3>
                    <p>Total Pesanan</p>
                </div>
                <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                    Lihat Semua <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Total Pendapatan --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    <p>Total Pendapatan</p>
                </div>
                <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Pesanan Baru --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pesananBaru }}</h3>
                    <p>Pesanan Perlu Diproses</p>
                </div>
                <div class="icon"><i class="fas fa-clock"></i></div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                    Proses Sekarang <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Total Produk --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $totalPakaian }}</h3>
                    <p>Total Produk Pakaian</p>
                </div>
                <div class="icon"><i class="fas fa-tshirt"></i></div>
                <a href="{{ route('pakaian.index') }}" class="small-box-footer">
                    Kelola Produk <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- ===== ALERT CARDS ===== --}}
    <div class="row">

        @if($stokHabis > 0)
        <div class="col-md-4 mb-3">
            <div class="alert alert-danger d-flex align-items-center mb-0 h-100" style="border-radius:8px;">
                <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                <div>
                    <strong>{{ $stokHabis }} produk stok habis!</strong><br>
                    <small>Segera tambah stok agar tidak kehilangan penjualan.</small>
                </div>
            </div>
        </div>
        @endif

        @if($stokMenipis > 0)
        <div class="col-md-4 mb-3">
            <div class="alert alert-warning d-flex align-items-center mb-0 h-100" style="border-radius:8px;">
                <i class="fas fa-exclamation-circle fa-2x mr-3"></i>
                <div>
                    <strong>{{ $stokMenipis }} produk stok menipis (≤5)!</strong><br>
                    <small>Pertimbangkan untuk segera restock.</small>
                </div>
            </div>
        </div>
        @endif

        @if($refundPending > 0)
        <div class="col-md-4 mb-3">
            <div class="alert alert-info d-flex align-items-center mb-0 h-100" style="border-radius:8px;">
                <i class="fas fa-undo fa-2x mr-3"></i>
                <div>
                    <strong>{{ $refundPending }} pengajuan refund menunggu!</strong><br>
                    <a href="{{ route('admin.orders.index') }}" class="alert-link">Tinjau sekarang</a>
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- ===== CHART + RECENT ORDERS ===== --}}
    <div class="row">

        {{-- Grafik Pendapatan Bulanan --}}
        <div class="col-lg-7 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar mr-2"></i>Pendapatan 6 Bulan Terakhir
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="120"></canvas>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="col-lg-5 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt mr-2"></i>Akses Cepat
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row g-2">
                        <div class="col-6 mb-2">
                            <a href="{{ route('pakaian.create') }}" class="btn btn-outline-primary btn-block py-3">
                                <i class="fas fa-plus-circle d-block mb-1" style="font-size:1.5rem;"></i>
                                Tambah Produk
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success btn-block py-3">
                                <i class="fas fa-shopping-bag d-block mb-1" style="font-size:1.5rem;"></i>
                                Lihat Pesanan
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('galeri.create') }}" class="btn btn-outline-warning btn-block py-3">
                                <i class="fas fa-images d-block mb-1" style="font-size:1.5rem;"></i>
                                Tambah Galeri
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('setting.index') }}" class="btn btn-outline-secondary btn-block py-3">
                                <i class="fas fa-cog d-block mb-1" style="font-size:1.5rem;"></i>
                                Setting
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('berita.create') }}" class="btn btn-outline-info btn-block py-3">
                                <i class="fas fa-newspaper d-block mb-1" style="font-size:1.5rem;"></i>
                                Tambah Berita
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('layanan.create') }}" class="btn btn-outline-danger btn-block py-3">
                                <i class="fas fa-tools d-block mb-1" style="font-size:1.5rem;"></i>
                                Tambah Layanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== 5 PESANAN TERBARU ===== --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 font-weight-bold text-primary">
                        <i class="fas fa-list mr-2"></i>5 Pesanan Terbaru
                    </h6>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Status Bayar</th>
                                    <th>Status Kirim</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesananTerbaru as $order)
                                <tr>
                                    <td><small class="text-muted">{{ $order->order_id_midtrans }}</small></td>
                                    <td>{{ $order->nama }}</td>
                                    <td><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
                                    <td>
                                        @if($order->status == 'paid')
                                            <span class="badge badge-success">Lunas</span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 'refunded')
                                            <span class="badge badge-info">Refunded</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->shipping_status)
                                            <span class="badge badge-primary">{{ ucfirst($order->shipping_status) }}</span>
                                        @else
                                            <span class="badge badge-light text-muted">Belum diproses</span>
                                        @endif
                                    </td>
                                    <td><small>{{ $order->created_at->format('d M Y') }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        Belum ada pesanan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    // Data dari PHP
    var labels = {!! json_encode($pendapatanBulanan->map(function($d) {
        $bulanNama = ['', 'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        return $bulanNama[$d->bulan] . ' ' . $d->tahun;
    })) !!};

    var data = {!! json_encode($pendapatanBulanan->pluck('total')) !!};

    var ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.length ? labels : ['Belum ada data'],
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: data.length ? data : [0],
                backgroundColor: 'rgba(60, 141, 188, 0.7)',
                borderColor: 'rgba(60, 141, 188, 1)',
                borderWidth: 1,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            return 'Rp ' + ctx.raw.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection