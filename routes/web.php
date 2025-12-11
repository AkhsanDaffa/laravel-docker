<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-input', function () {
    try {
        User::create([
            'name' => 'Daffa DevOps',
            'email' => 'Daffa@devops.com',
            'password' => Hash::make('rahasia123'),
        ]);
        return "<h1>✅ SUKSES! Data 'Daffa DevOps' berhasil masuk ke Database.</h1>";
    } catch (\Exception $e) {
        return "<h1>❌ GAGAL: " . $e->getMessage() . "</h1>";
    }
});
