<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        return view('admin.feedback.index', compact('feedbacks')); // Pastikan return view jika diakses langsung
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
        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback berhasil dihapus.');
    }
}
