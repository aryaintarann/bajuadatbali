<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only insert if table is empty
        if (DB::table('setting')->count() === 0) {
            DB::table('setting')->insert([
                'instansi_setting'   => 'Baju Adat Bali',
                'pimpinan_setting'   => 'Pimpinan',
                'logo_setting'       => null,
                'logo_login_setting' => null,
                'favicon_setting'    => null,
                'tentang_setting'    => 'Platform penjualan busana adat Bali terpercaya.',
                'misi_setting'       => null,
                'visi_setting'       => null,
                'keyword_setting'    => 'Busana Adat Bali, Baju Adat Bali, Kebaya Bali',
                'alamat_setting'     => 'Bali, Indonesia',
                'instagram_setting'  => null,
                'youtube_setting'    => null,
                'email_setting'      => 'info@bajuadatbali.com',
                'no_hp_setting'      => '-',
                'maps_setting'       => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }
}
