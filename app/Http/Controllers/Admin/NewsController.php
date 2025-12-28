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
        // View biasanya menyatu di dashboard atau ada route sendiri
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
            // PERBAIKAN: Simpan ke 's3' (Supabase) karena Vercel Read-Only
            $imagePath = $request->file('image')->store('news', 's3');
        }

        // LOGIC SLUG UNIK
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
        // View edit
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

        // Tetapkan path lama sebagai default
        $imagePath = $news->image;
        $newTitle = $request->input('title');
        
        // LOGIC SLUG UPDATE UNIK
        $baseSlug = Str::slug($newTitle);
        $slug = $news->slug;

        if ($newTitle !== $news->title) {
            $slug = $baseSlug;
            $count = 1;
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
        }
        
        if ($request->hasFile('image')) {
            // Hapus foto lama di Supabase (disk s3) jika ada
            if ($news->image) {
                Storage::disk('s3')->delete($news->image);
            }
            // PERBAIKAN: Simpan ke 's3' dan masukkan ke variabel $imagePath
            $imagePath = $request->file('image')->store('news', 's3');
        }

        $news->update([
            'title' => $newTitle,
            'slug' => $slug,
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
            'author' => Auth::user()->name ?? 'Admin',
            'image' => $imagePath, // Pastikan menggunakan $imagePath terbaru
            'status' => $request->input('status'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        // Hapus file dari Supabase sebelum menghapus data di database
        if ($news->image) {
            Storage::disk('s3')->delete($news->image);
        }
        
        $news->delete();
        return redirect()->route('dashboard')->with('success', 'Berita berhasil dihapus.');
    }
}
