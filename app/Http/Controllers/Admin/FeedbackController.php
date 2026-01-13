<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        return view('admin.feedback.index', compact('feedbacks')); 
    }

    // Metode untuk menandai feedback sudah dibaca (Update)
    public function update(Request $request, Feedback $feedback)
    {
        $feedback->update([
            'is_read' => $request->is_read ?? true
        ]);

        return response()->json(['success' => true]);
    }

    // Metode untuk menghapus feedback (Destroy)
    public function destroy(Feedback $feedback)
    {
        // Hapus file gambar dari Supabase jika ada
        if ($feedback->image) {
            Storage::disk('s3')->delete($feedback->image);
        }

        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback berhasil dihapus.');
    }
}
