@extends('layouts.web')

@section('isi')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    // Kirim data transaksi ke server
                    fetch("/checkout/save-order", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(result) // Kirim hasil pembayaran ke server
                        })
                        .then(response => {
                            return response.json().then(data => {
                                if (!response.ok) {
                                    throw new Error(data.message || "Gagal menyimpan transaksi.");
                                }
                                return data;
                            });
                        })
                        .then(data => {
                            // Setelah transaksi tersimpan, arahkan ke halaman sukses
                            window.location.href = "/checkout/success";
                        })
                        .catch(error => {
                            console.error("Error saat menyimpan transaksi:", error);
                            alert("Terjadi kesalahan: " + error.message);
                        });
                },
                onPending: function(result) {
                    alert("Transaksi tertunda. Silakan selesaikan pembayaran.");
                },
                onError: function(result) {
                    console.error("Transaksi gagal:", result);
                    alert("Transaksi gagal. Silakan coba lagi.");
                },
                onClose: function() {
                    alert("Anda menutup jendela pembayaran sebelum menyelesaikan transaksi.");
                    window.location.href = "/checkout";
                }
            });
        });
    </script>

    <h4>Mohon tunggu, sedang mengarahkan ke pembayaran...</h4>
@endsection
