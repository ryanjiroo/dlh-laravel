<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'Pentingnya Daur Ulang di Perkotaan',
            'slug' => 'pentingnya-daur-ulang-di-perkotaan',
            'excerpt' => 'Dinas Lingkungan Hidup meluncurkan program baru untuk meningkatkan kesadaran daur ulang di wilayah kota.',
            'content' => 'Detail lengkap mengenai program daur ulang terbaru. Program ini mencakup penyediaan tempat sampah terpisah dan jadwal penjemputan khusus...',
            'author' => 'Budi Santoso',
            'status' => 'Published',
        ]);

        News::create([
            'title' => 'Mengurangi Sampah Plastik Harian',
            'slug' => 'mengurangi-sampah-plastik-harian',
            'excerpt' => 'Tips sederhana yang dapat dilakukan warga untuk mengurangi penggunaan plastik sekali pakai dan mendukung lingkungan.',
            'content' => 'Gunakan tas belanja sendiri, hindari sedotan plastik, dan bawa botol minum isi ulang. Perubahan kecil memberikan dampak besar.',
            'author' => 'Citra Lestari',
            'status' => 'Published',
        ]);
    }
}