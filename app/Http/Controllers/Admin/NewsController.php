<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        // View terpisah jika diperlukan
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|in:Draft,Published',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        // LOGIC SLUG UNIK: Memastikan slug tidak duplikat
        $baseSlug = Str::slug($request->input('title'));
        $slug = $baseSlug;
        $count = 1;

        while (News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        News::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
            'author' => Auth::user()->name ?? 'Admin', 
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        // View terpisah jika diperlukan
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Draft,Published',
        ]);

        $imagePath = $news->image;
        $newTitle = $request->input('title');
        
        // LOGIC SLUG UPDATE UNIK
        $slug = $news->slug;
        $baseSlug = Str::slug($newTitle);
        
        // Hanya update slug jika judul berubah DAN slug yang dihasilkan berbeda dari slug saat ini
        if ($baseSlug !== Str::beforeLast($news->slug, '-') || !News::where('slug', $baseSlug)->where('id', '!=', $news->id)->exists()) {
            $slug = $baseSlug;
            $count = 1;
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
        }
        
        if ($request->hasFile('image')) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $path = $request->file('image')->store('images/news', 'public');
        }

        $news->update([
            'title' => $newTitle,
            'slug' => $slug,
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
            'author' => Auth::user()->name ?? 'Admin',
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Berita berhasil diperbarui!');
    }

    public function show(News $news)
    {
        // Rute publik sudah ada
    }

    public function destroy(News $news)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();
        return redirect()->route('dashboard')->with('success', 'Berita berhasil dihapus.');
    }
}
