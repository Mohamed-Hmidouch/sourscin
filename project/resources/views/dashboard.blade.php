<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - Quiz Admin')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity -->
        <div class="card bg-white rounded-xl shadow-sm p-6 col-span-1 lg:col-span-2">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
            </div>
            <div class="space-y-4">
                @forelse($recentActivities ?? [] as $activity)
                    <div class="flex items-center p-3 border-l-4 border-blue-400 bg-blue-50 rounded-r-lg">
                        <div class="bg-blue-100 p-2 rounded-full mr-4">
                            <i class="fas fa-{{ $activity->icon ?? 'check' }} text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">{{ $activity->description ?? 'New quiz completed' }}</p>
                            <p class="text-xs text-gray-500">{{ $activity->created_at ?? now()->subHours(rand(1, 24))->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    @for($i = 0; $i < 3; $i++)
                        <div class="flex items-center p-3 border-l-4 {{ ['border-blue-400', 'border-green-400', 'border-purple-400'][$i] }} {{ ['bg-blue-50', 'bg-green-50', 'bg-purple-50'][$i] }} rounded-r-lg">
                            <div class="{{ ['bg-blue-100', 'bg-green-100', 'bg-purple-100'][$i] }} p-2 rounded-full mr-4">
                                <i class="fas {{ ['fa-user-graduate', 'fa-trophy', 'fa-clipboard-check'][$i] }} {{ ['text-blue-600', 'text-green-600', 'text-purple-600'][$i] }}"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">{{ ['New participant joined Quiz #12', 'High score achieved in GK Quiz', 'Quiz "Science 101" published'][$i] }}</p>
                                <p class="text-xs text-gray-500">{{ now()->subHours(rand(1, 24))->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-5">Quick Actions</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center p-3 rounded-lg transition hover:bg-blue-50 border border-gray-100">
                    <div class="p-2 bg-blue-100 rounded-full">
                        <i class="fas fa-plus text-blue-600 text-sm"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">Create New Quiz</p>
                    </div>
                </a>
                <a href="#" onclick="openQuestionModal()" class="flex items-center p-3 rounded-lg transition hover:bg-green-50 border border-gray-100">
                    <div class="p-2 bg-green-100 rounded-full">
                        <i class="fas fa-question text-green-600 text-sm"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">Add New Question</p>
                    </div>
                </a>
                <a href="#" class="flex items-center p-3 rounded-lg transition hover:bg-purple-50 border border-gray-100">
                    <div class="p-2 bg-purple-100 rounded-full">
                        <i class="fas fa-download text-purple-600 text-sm"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">Export Results</p>
                    </div>
                </a>
                <a href="#" class="flex items-center p-3 rounded-lg transition hover:bg-amber-50 border border-gray-100">
                    <div class="p-2 bg-amber-100 rounded-full">
                        <i class="fas fa-cog text-amber-600 text-sm"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">Settings</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Performance Chart & Upcoming Quizzes -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="card bg-white rounded-xl shadow-sm p-6 col-span-1 lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-800 mb-5">Quiz Performance</h3>
            <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                <!-- Chart would go here, replaced with placeholder -->
                <p class="text-sm text-gray-500">Chart visualization would appear here</p>
            </div>
        </div>
        
        <div class="card bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-5">Upcoming Quizzes</h3>
            @forelse($upcomingQuizzes ?? [] as $quiz)
                <div class="mb-4 border-l-4 border-blue-400 pl-4">
                    <p class="text-sm font-medium text-gray-800">{{ $quiz->title ?? 'Quiz Title' }}</p>
                    <p class="text-xs text-gray-500">{{ $quiz->scheduled_for ?? now()->addDays(rand(1,5))->format('M d, Y') }}</p>
                </div>
            @empty
                @for($i = 0; $i < 3; $i++)
                    <div class="mb-4 border-l-4 border-blue-400 pl-4">
                        <p class="text-sm font-medium text-gray-800">{{ ['Technology Quiz', 'History Basics', 'Math Challenge'][$i] }}</p>
                        <p class="text-xs text-gray-500">{{ now()->addDays($i + 1)->format('M d, Y') }}</p>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
    
    <!-- Question Modal -->
    <x-modal id="questionModal" max-width="2xl">
        <x-questions.form :quizId="1" />
    </x-modal>

    <script>
        function openQuestionModal() {
            document.getElementById('questionModal').__x.$data.show = true;
        }
    </script>

    <!-- Ajoutez cette section après vos sections existantes -->
    <div class="card bg-white rounded-xl shadow-sm p-6 mt-6">
        <h3 class="text-lg font-bold text-gray-800 mb-5">Questions récentes</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quiz</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentQuestions ?? [] as $question)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $question->question_text }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $question->question_type)) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $question->quiz->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $question->points }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Aucune question trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection