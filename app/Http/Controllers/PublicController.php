<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    // --- Home ---
    public function index()
    {
        // Load 4 berita terbaru yang sudah dipublikasikan
        $latestNews = News::where('status', 'Published')->orderBy('created_at', 'desc')->take(4)->get();
        return view('pages.home', compact('latestNews'));
    }

    // --- Berita Daftar ---
    public function newsIndex(Request $request)
    {
        $search = $request->input('search');

        // Query dasar: hanya berita yang sudah dipublikasikan
        $query = News::where('status', 'Published');

        // Jika ada input pencarian, tambahkan kondisi WHERE
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%');
            });
        }

        // Ambil data dengan pagination dan tetap simpan parameter search di link halaman
        $news = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('pages.berita', compact('news'));
    }

    // --- Berita Tunggal ---
    public function showNews($slug)
    {
        $article = News::where('slug', $slug)
                    ->where('status', 'Published')
                    ->firstOrFail();

        return view('pages.beritatunggal', compact('article'));
    }

    // --- Submit Feedback ---
    public function submitFeedback(Request $request)
    {
        // Validasi: email wajib, image opsional
        $request->validate([
            'message' => 'required|string|max:1000',
            'sender_name' => 'nullable|string|max:100',
            'sender_email' => 'required|email|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder feedback di disk s3 (Supabase)
            $imagePath = $request->file('image')->store('feedback', 's3');
        }

        Feedback::create([
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'message' => $request->message,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Terima kasih atas saran Anda! Kami akan meninjaunya.');
    }
}
