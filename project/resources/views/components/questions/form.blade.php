<form id="questionForm" method="POST" action="{{ route('questions.store') }}" class="p-6">
    @csrf
    <input type="hidden" name="quiz_id" value="1">
    <h2 class="text-lg font-medium text-gray-900 mb-4">
        {{ __('Add New Question') }}
    </h2>
    
    <div class="mb-4">
        <label for="question_text" class="block text-sm font-medium text-gray-700">Question Text</label>
        <textarea id="question_text" name="question_text" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
    </div>
    
    <div class="mb-4">
        <label for="question_type" class="block text-sm font-medium text-gray-700">Question Type</label>
        <select id="question_type" name="question_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="toggleOptions()">
            <option value="multiple_choice">Multiple Choice</option>
            <option value="true_false">True/False</option>
            <option value="short_answer">Short Answer</option>
        </select>
    </div>
    
    <!-- Options container for multiple choice questions -->
    <div id="options_container" class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
        <div id="options_list" class="space-y-2">
            <div class="flex items-center">
                <input type="radio" name="correct_option" value="0" class="mr-2">
                <input type="text" name="options[]" placeholder="Option 1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="flex items-center">
                <input type="radio" name="correct_option" value="1" class="mr-2">
                <input type="text" name="options[]" placeholder="Option 2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>
        <button type="button" onclick="addOption()" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-plus mr-1"></i> Add Option
        </button>
    </div>
    
    <!-- True/False answer container -->
    <div id="true_false_container" class="mb-4 hidden">
        <label class="block text-sm font-medium text-gray-700">Correct Answer</label>
        <div class="mt-2">
            <label class="inline-flex items-center">
                <input type="radio" name="correct_answer_tf" value="true" class="form-radio">
                <span class="ml-2">True</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input type="radio" name="correct_answer_tf" value="false" class="form-radio">
                <span class="ml-2">False</span>
            </label>
        </div>
    </div>
    
    <!-- Short answer container -->
    <div id="short_answer_container" class="mb-4 hidden">
        <label for="correct_answer_sa" class="block text-sm font-medium text-gray-700">Correct Answer</label>
        <input type="text" id="correct_answer_sa" name="correct_answer_sa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>
    
    <div class="mb-4">
        <label for="points" class="block text-sm font-medium text-gray-700">Points</label>
        <input type="number" id="points" name="points" value="1" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>
    
    <div class="mt-6 flex justify-end">
        <button type="button" onclick="closeModal()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50">
            Cancel
        </button>
        <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300">
            Save Question
        </button>
    </div>
</form>
