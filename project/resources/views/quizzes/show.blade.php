@extends('layouts.app')

@section('title', $quiz->title . ' - Quiz Admin Dashboard')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ $quiz->title }}</h1>
            <button 
                type="button" 
                onclick="openQuestionModal()"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300">
                <i class="fas fa-plus mr-2"></i> Add Question
            </button>
        </div>
        
        <div class="mb-6">
            <p class="text-gray-600">{{ $quiz->description }}</p>
            <div class="mt-2 flex items-center">
                <span class="mr-4 text-sm text-gray-500">
                    <i class="far fa-clock mr-1"></i> {{ $quiz->duration }} minutes
                </span>
                <span class="text-sm text-gray-500">
                    <i class="fas fa-chart-bar mr-1"></i> {{ ucfirst($quiz->difficulty) }}
                </span>
            </div>
        </div>
        
        <!-- Questions List -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Questions</h2>
            
            @if($quiz->questions->count() > 0)
                <div class="space-y-4">
                    @foreach($quiz->questions as $index => $question)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between">
                                <h3 class="font-medium">{{ $index + 1 }}. {{ $question->question_text }}</h3>
                                <div>
                                    <button class="text-blue-600 hover:text-blue-800 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst(str_replace('_', ' ', $question->question_type)) }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $question->points }} Points
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-500">No questions added yet. Click "Add Question" to create your first question.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Question Modal -->
    <x-modal id="questionModal" max-width="2xl">
        <x-questions.form :quizId="$quiz->id" />
    </x-modal>

    <script>
        window.openQuestionModal = function() {
            document.getElementById('questionModal').__x.$data.show = true;
        }
    </script>
@endsection