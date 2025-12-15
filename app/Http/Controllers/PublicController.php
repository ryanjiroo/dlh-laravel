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
    public function newsIndex()
    {
        // Load semua berita yang diterbitkan dengan pagination
        $news = News::where('status', 'Published')->orderBy('created_at', 'desc')->paginate(12);
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