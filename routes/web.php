<?php

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriPakaianController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\PakaianController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===== SIGNUP DISABLED — redirect /register ke /login =====
Route::get('/register', fn() => redirect()->route('login'))->name('register');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/pencarian', [PakaianController::class, 'cari'])->name('pencarian');

// Product detail
Route::get('/pakaian-details/{slug}', [HomeController::class, 'detailpakaian'])->name('pakaian-details.show');

// Service detail
Route::get('/layanan-details/{slug}', [HomeController::class, 'detaillayanan'])->name('layanan-details.show');

// Berita detail
Route::get('/beritas/{slug}', [HomeController::class, 'detailBerita'])->name('berita.detail');

// ===== ORDER TRACKING (public — guest bisa cek status pesanan) =====
Route::get('/cek-pesanan', [OrderTrackingController::class, 'index'])->name('order.tracking');
Route::post('/cek-pesanan', [OrderTrackingController::class, 'search'])->name('order.tracking.search');

// ===== CART ROUTES =====
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{id}', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::put('/cart/update-size/{id}', [CartController::class, 'updateSize'])->name('cart.update_size');

// ===== CHECKOUT ROUTES (semua publik — guest checkout diizinkan) =====
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::post('/checkout/save-order', [CheckoutController::class, 'simpanSetelahBayar'])->name('checkout.saveOrder');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// ===== REFUND REQUEST (public — throttle 5x/mnt untuk cegah spam) =====
Route::get('/refund', [RefundController::class, 'showForm'])->name('refund.form');
Route::post('/refund/request', [RefundController::class, 'requestRefund'])
    ->name('refund.request')
    ->middleware('throttle:5,1');



// ===== ADMIN-ONLY ROUTES (protected by auth + admin role check) =====
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'check.user.role'])->group(function () {
    Route::post('/refund/{id}/approve', [RefundController::class, 'approveRefund'])->name('refund.approve');
    Route::post('/refund/{id}/reject', [RefundController::class, 'rejectRefund'])->name('refund.reject');

    Route::post(
        '/admin/orders/{order}/shipping-status',
        [AdminOrderController::class, 'updateShippingStatus']
    )->name('orders.shipping-status');
});

// ===== AUTHENTICATED ROUTES =====
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index')
        ->middleware('check.user.role');

    Route::post('image-upload', [SettingController::class, 'storeImage'])->name('image.upload');
    Route::resource('setting', SettingController::class);
    Route::post('setting/change-password', [SettingController::class, 'changePassword'])->name('setting.change-password');

    Route::post('/payment/notification', [PaymentController::class, 'notificationHandler'])->name('payment.notification');

    Route::resource('pakaian', PakaianController::class);
    Route::resource('kategori_pakaian', KategoriPakaianController::class);

    Route::resource('berita', BeritaController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('galeri', GaleriController::class);

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
});
