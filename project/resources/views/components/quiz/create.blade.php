<!-- filepath: /c:/Users/youcode/Desktop/sourscin/project/resources/views/components/question/create.blade.php -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('questions.store') }}">
                @csrf
                <div>
                    <x-label for="quiz_id" :value="__('Quiz')" />
                    <select id="quiz_id" class="block mt-1 w-full" name="quiz_id" required>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <x-label for="question" :value="__('Question')" />
                    <textarea id="question" class="block mt-1 w-full" name="question" required></textarea>
                </div>
                <div class="mt-4">
                    <x-label for="type" :value="__('Type')" />
                    <select id="type" class="block mt-1 w-full" name="type" required>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="true_false">True/False</option>
                        <option value="short_answer">Short Answer</option>
                    </select>
                </div>
                <div class="mt-4">
                    <x-button>
                        {{ __('Create Question') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>