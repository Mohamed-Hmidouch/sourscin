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