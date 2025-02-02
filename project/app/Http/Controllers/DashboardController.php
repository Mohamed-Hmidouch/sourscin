<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

class DashboardController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        $recentQuestions = Question::with('quiz')->latest()->take(5)->get();
        
        return view('dashboard', compact('quizzes', 'recentQuestions'));
    }
}
