<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class DashboardController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('dashboard', compact('quizzes'));
    }
}
