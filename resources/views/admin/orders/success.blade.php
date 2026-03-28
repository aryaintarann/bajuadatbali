<?php
$title = 'Payment';
?>

@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                   <h1>Pembayaran Sukses</h1>
                   <button href="{{url('order.index')}}" class="btn btn-success">Kembali Ke Halaman</button>
                </div>
            </div>
        </div>
    </div>
@endsection

