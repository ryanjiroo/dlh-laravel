<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Feedback;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua berita (diurutkan dari yang terbaru)
        $news = News::orderBy('created_at', 'desc')->get();
        
        // Mengambil data feedback
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        $unreadFeedbackCount = Feedback::where('is_read', false)->count();

        // Mengirimkan variabel 'news' ke view
        return view('pages.dashboard', compact('news', 'feedbacks', 'unreadFeedbackCount'));
    }
}
