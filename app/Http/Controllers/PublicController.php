<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $request->validate([
            'message' => 'required|string|max:1000',
            'sender_name' => 'nullable|string|max:100',
            'sender_email' => 'nullable|email|max:100',
        ]);

        Feedback::create($request->only(['message', 'sender_name', 'sender_email']));

        return back()->with('success', 'Terima kasih atas saran Anda! Kami akan meninjaunya.');
    }
}
