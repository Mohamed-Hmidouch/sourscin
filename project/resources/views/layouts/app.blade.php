<!-- filepath: /c:/Users/youcode/Desktop/sourscin/project/resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tableau de Bord Principal -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Tableau de Bord Principal</h3>
                    <p>Vue d’ensemble des quiz créés, du nombre d’utilisateurs actifs et des performances globales des tests.</p>
                    <!-- Add your dynamic charts and statistics here -->
                </div>
            </div>

            <!-- Gestion des Quiz -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Gestion des Quiz</h3>
                    <p>Créer, modifier et supprimer des quiz.</p>
                    <!-- Add your quiz management interface here -->
                </div>
            </div>

            <!-- Création et Gestion des Questions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Création et Gestion des Questions</h3>
                    <p>Ajouter des questions de différentes natures : QCM, vrai/faux, réponse courte, etc.</p>
                    <!-- Add your question management interface here -->
                </div>
            </div>

            <!-- Gestion des Utilisateurs -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Gestion des Utilisateurs</h3>
                    <p>Voir la liste des utilisateurs inscrits, leur progression et leurs scores aux différents quiz.</p>
                    <!-- Add your user management interface here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>