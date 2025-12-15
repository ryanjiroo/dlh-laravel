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
        $articles = News::orderBy('created_at', 'desc')->get();
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        $unreadFeedbackCount = Feedback::where('is_read', false)->count();

        return view('pages.dashboard', compact('articles', 'feedbacks', 'unreadFeedbackCount'));
    }
}