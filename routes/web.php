<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    // 1. Cek Koneksi Database
    try {
        DB::connection()->getPdo();
        $db_status = "Connected 🟢";
        $db_name = DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        $db_status = "Error 🔴";
        $db_name = "-";
    }

    // 2. Kirim data ke tampilan (View)
    return view('welcome', [
        'db_status' => $db_status,
        'db_name' => $db_name,
        'server_ip' => $_SERVER['SERVER_ADDR'] ?? '127.0.0.1',
        'software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Nginx/Docker',
        'php_version' => phpversion()
    ]);
});

// Route pemicu input data (yang tadi kita buat)
Route::get('/test-input', function () {
    try {
        \App\Models\User::create([
            'name' => 'Teman Pamer ' . rand(1,100),
            'email' => 'teman'.rand(1,1000).'@pamer.com',
            'password' => \Illuminate\Support\Facades\Hash::make('rahasia'),
        ]);
        return redirect('/')->with('success', 'User Baru Berhasil Dibuat!');
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Gagal buat user: ' . $e->getMessage());
    }
});