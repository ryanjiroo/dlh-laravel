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
        // Akan dipanggil di DashboardController
        return $feedbacks;
    }

    // Tambahkan fungsi view/show, markAsRead, destroy di sini
    // ...
}