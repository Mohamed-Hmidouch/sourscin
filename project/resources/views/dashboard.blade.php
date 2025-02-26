<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Changed to Montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white">
            <div class="p-6">
            <h1 class="text-2xl font-bold tracking-tight flex items-center gap-3">
                <i class="fas fa-brain"></i>
                Quiz Manager
            </h1>
            <p class="text-blue-100 text-xs mt-2">Administration Panel</p>
            </div>
            <nav class="mt-6 px-4">
            <div class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class="flex items-center py-3 px-4 rounded-lg transition duration-200 {{ request()->is('dashboard') ? 'bg-white bg-opacity-20 font-medium' : 'hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-home mr-3"></i> Dashboard
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/questions" class="flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-white hover:bg-opacity-10">
                <i class="fas fa-question-circle mr-3"></i> Questions
                </a>
            </div>
            
            <div class="nav-item {{ request()->is('quizzes*') ? 'active' : '' }}">
                <a href="/quizzes" class="flex items-center py-3 px-4 rounded-lg transition duration-200 {{ request()->is('quizzes*') ? 'bg-white bg-opacity-20 font-medium' : 'hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-list mr-3"></i> Quizzes
                </a>
            </div>
            
            <div class="nav-item {{ request()->is('analytics') ? 'active' : '' }}">
                <a href="/analytics" class="flex items-center py-3 px-4 rounded-lg transition duration-200 {{ request()->is('analytics') ? 'bg-white bg-opacity-20 font-medium' : 'hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-chart-bar mr-3"></i> Analytics
                </a>
            </div>
            
            <div class="nav-item {{ request()->is('settings') ? 'active' : '' }}">
                <a href="/settings" class="flex items-center py-3 px-4 rounded-lg transition duration-200 {{ request()->is('settings') ? 'bg-white bg-opacity-20 font-medium' : 'hover:bg-white hover:bg-opacity-10' }}">
                <i class="fas fa-cog mr-3"></i> Settings
                </a>
            </div>
            
            <div class="mt-8 px-4 py-4 text-xs bg-blue-900 bg-opacity-40 rounded-lg">
                <p class="font-medium text-white mb-2">System Status</p>
                <div class="flex justify-between items-center mb-2">
                <span class="text-blue-200">Storage</span>
                <span class="text-blue-100">65%</span>
                </div>
                <div class="w-full bg-blue-800 rounded-full h-1.5">
                <div class="bg-blue-300 h-1.5 rounded-full" style="width: 65%"></div>
                </div>
            </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Top Header -->
            <header class="dashboard-header sticky top-0 z-10 py-4 px-6 flex items-center justify-between shadow-sm">
                <div class="flex items-center">
                    <button class="text-gray-500 hover:text-gray-700 mr-4 md:hidden">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}</h2>
                    <span class="ml-2 text-sm bg-blue-100 text-blue-600 py-0.5 px-2 rounded-full">Admin</span>
                </div>
                <div class="flex items-center space-x-5">
                    <div class="relative">
                        <button class="text-gray-500 hover:text-gray-700 transition">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 rounded-full w-5 h-5 text-xs flex items-center justify-center text-white">3</span>
                        </button>
                    </div>
                    <div class="relative">
                        <button class="text-gray-500 hover:text-gray-700 transition">
                            <i class="fas fa-envelope text-lg"></i>
                            <span class="absolute -top-1 -right-1 bg-blue-500 rounded-full w-5 h-5 text-xs flex items-center justify-center text-white">7</span>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <div class="mr-3 text-right hidden md:block">
                            <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="relative group">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=ffffff" alt="Profile" class="h-10 w-10 rounded-full border-2 border-blue-400 cursor-pointer">
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 hidden group-hover:block">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
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
                        <a href="/quizzes/create" class="flex items-center p-3 rounded-lg transition hover:bg-blue-50 border border-gray-100">
                            <div class="p-2 bg-blue-100 rounded-full">
                                <i class="fas fa-plus text-blue-600 text-sm"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Create New Quiz</p>
                            </div>
                        </a>
                        <a href="/questions/create" class="flex items-center p-3 rounded-lg transition hover:bg-green-50 border border-gray-100">
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
                        <a href="/settings" class="flex items-center p-3 rounded-lg transition hover:bg-amber-50 border border-gray-100">
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
        </main>
    </div>
</div>
</body>
</html>