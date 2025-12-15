<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feedback::create([
            'sender_name' => 'Warga A',
            'message' => 'Layanan pengangkutan sampah sangat cepat dan efisien. Terima kasih!',
            'is_read' => true,
        ]);

        Feedback::create([
            'sender_name' => 'Warga B',
            'message' => 'Perlu penambahan tempat sampah di area taman kota. Mohon dipertimbangkan.',
            'is_read' => false,
        ]);
    }
}