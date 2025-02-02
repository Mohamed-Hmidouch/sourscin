<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quiz Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Add Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
        }
        .sidebar-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
        .btn-primary {
            background: linear-gradient(90deg, #3b82f6 0%, #1e40af 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);
        }
        .card {
            transition: all 0.4s ease;
            border-left: 4px solid transparent;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .card-quiz {
            border-left-color: #3b82f6;
        }
        .card-questions {
            border-left-color: #10b981;
        }
        .card-participants {
            border-left-color: #8b5cf6;
        }
        .card-score {
            border-left-color: #f59e0b;
        }
        .dashboard-header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(209, 213, 219, 0.3);
        }
        .nav-item {
            position: relative;
            margin-bottom: 0.5rem;
        }
        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: white;
            opacity: 0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .nav-item:hover::before {
            width: 4px;
            opacity: 0.7;
        }
        .nav-item.active::before {
            width: 4px;
            opacity: 1;
        }
        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.75rem;
            margin-top: 0.75rem;
        }
        .stat-up {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        .stat-down {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        @include('layouts.partials.sidebar')
        
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            @include('layouts.partials.header')

            <main class="p-6">
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        // وظائف جافاسكريبت لنموذج الأسئلة
function toggleOptions() {
    const questionType = document.getElementById('question_type').value;
    
    // إخفاء جميع الحاويات أولاً
    document.getElementById('options_container').classList.add('hidden');
    document.getElementById('true_false_container').classList.add('hidden');
    document.getElementById('short_answer_container').classList.add('hidden');
    
    // إظهار الحاوية المناسبة
    if (questionType === 'multiple_choice') {
        document.getElementById('options_container').classList.remove('hidden');
    } else if (questionType === 'true_false') {
        document.getElementById('true_false_container').classList.remove('hidden');
    } else if (questionType === 'short_answer') {
        document.getElementById('short_answer_container').classList.remove('hidden');
    }
}

// وظيفة لإضافة خيار جديد
let optionCounter = 2; // بدءاً من 2 لأن لدينا بالفعل خياران

function addOption() {
    optionCounter++;
    const optionsContainer = document.getElementById('options_list');
    
    const optionDiv = document.createElement('div');
    optionDiv.className = 'flex items-center';
    
    // إنشاء زر الراديو للإجابة الصحيحة
    const radio = document.createElement('input');
    radio.type = 'radio';
    radio.name = 'correct_option';
    radio.value = (optionCounter - 1).toString(); // القيمة هي الفهرس
    radio.className = 'mr-2';
    
    // إنشاء حقل النص للخيار
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'options[]';
    input.placeholder = `Option ${optionCounter}`;
    input.className = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50';
    
    // إنشاء زر الحذف
    const deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.className = 'ml-2 text-red-500';
    deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
    deleteButton.onclick = function() {
        optionsContainer.removeChild(optionDiv);
    };
    
    // إضافة العناصر إلى الحاوية
    optionDiv.appendChild(radio);
    optionDiv.appendChild(input);
    optionDiv.appendChild(deleteButton);
    
    optionsContainer.appendChild(optionDiv);
}

// وظيفة لإغلاق النافذة المنبثقة إذا كنت تستخدمها
function closeModal() {
    // إذا كان النموذج داخل نافذة منبثقة، يمكنك إخفاؤها هنا
    // مثال: document.getElementById('questionModal').style.display = 'none';
    // أو إعادة التوجيه إلى الصفحة السابقة
    window.history.back();
}

// تنفيذ وظيفة التبديل عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    toggleOptions(); // لضمان إظهار الخيارات الصحيحة عند تحميل الصفحة
    
    // إضافة مؤشر تحميل أثناء الإرسال
    document.getElementById('questionForm').addEventListener('submit', function() {
        // يمكنك إضافة مؤشر تحميل هنا قبل الإرسال
        console.log('Form submitting...');
    });
});
    </script>
</body>
</html>