<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create()
    {
        return view('question.create');
    }

    public function store(Request $request)
    {

        // Debug: Dump request information
        dump('Question submission data:', $request->all());

        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false,short_answer',
            'points' => 'required|integer|min:1',
        ]);
 

        $question = new Question();
        $question->quiz_id = $request->quiz_id;
        $question->question_text = $request->question_text;
        $question->question_type = $request->question_type;
        $question->points = $request->points;
        // Handle different question types
        if ($request->question_type === 'multiple_choice') {
            $request->validate([
                'options' => 'required|array|min:2',
                'options.*' => 'required|string',
                'correct_option' => 'required|integer|min:0',
            ]);

            $question->options = $request->options;
            $question->correct_answer = $request->options[$request->correct_option];
        }
        else if ($request->question_type === 'true_false') {
            $request->validate([
                'correct_answer_tf' => 'required|in:true,false',
            ]);

            $question->options = ['True', 'False'];
            $question->correct_answer = $request->correct_answer_tf;
        }
        else if ($request->question_type === 'short_answer') {
            $request->validate([
                'correct_answer_sa' => 'required|string',
            ]);

            $question->options = null;
            $question->correct_answer = $request->correct_answer_sa;
        }

        $question->save();

        return redirect()->back()->with('success', 'Question added successfully!');
    }
}
