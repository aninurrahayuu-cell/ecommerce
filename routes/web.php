<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/sapa/{ani}', function ($ani) {
    return "Halo, $ani! Selamat datang di Toko Online.";
});

Route::get('/kategori/{ani?}', function ($ani = 'Semua') {
    return "Menampilkan kategori: $ani";
});

Route::get('/produk/{id}', function ($id) {
    return "Detail produk #$id";
})->name('produk.detail');
