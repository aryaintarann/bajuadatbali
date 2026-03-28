<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Buat akun admin (id=1) jika belum ada.
     */
    public function run(): void
    {
        // Hanya insert jika belum ada user sama sekali
        if (DB::table('users')->count() === 0) {
            DB::table('users')->insert([
                'name'              => 'Administrator',
                'email'             => 'admin@bajuadatbali.com',
                'password'          => Hash::make('admin123'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
