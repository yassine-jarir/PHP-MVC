<?php
// Views/admin/course.php
use App\Services\AuthService;
$userRole = AuthService::isAuthenticated();
// Vérification de la session admin
if (!AuthService::hasRole('admin')) {
    header('Location: /login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Barre de navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex h-16 items-center justify-between">
                <a href="/admin/dashboard" class="flex items-center space-x-2 text-indigo-600 hover:text-indigo-500">
                    <i class="fas fa-arrow-left"></i>
                    <span class="font-medium">Back to Dashboard</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Messages de notification -->
    <div class="max-w-4xl mx-auto pt-6 px-4">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                    <p class="text-green-600"><?php echo $_SESSION['success_message']; ?></p>
                </div>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-400 mr-2"></i>
                    <p class="text-red-600"><?php echo $_SESSION['error_message']; ?></p>
                </div>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
    </div>

    <!-- Contenu principal -->
    <main class="max-w-4xl mx-auto py-8 px-4">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Add New Course</h1>
            <p class="mt-2 text-gray-600">Create a new course to share knowledge with your students</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form method="POST" action="/admin/course/add" class="p-8">
                <div class="space-y-6">
                    <!-- Titre du cours -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Course Title
                        </label>
                        <input type="text" id="title" name="title" required
                               class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Enter the course title">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Course Description
                        </label>
                        <textarea id="description" name="description" rows="4" required
                                  class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Describe your course"></textarea>
                    </div>

                    <!-- Image URL -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                            Course Image URL
                        </label>
                        <input type="text" id="image" name="image"
                               class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Enter the image URL">
                        <p class="mt-2 text-sm text-gray-500">Enter a URL for the course cover image</p>
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                            Category
                        </label>
                        <select id="category" name="category_id" required
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select a category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Contenu -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                            Course Content
                        </label>
                        <textarea id="content" name="content" rows="10" required
                                  class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Write your course content here"></textarea>
                        <p class="mt-2 text-sm text-gray-500">Write your course content in detail</p>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex justify-end pt-6">
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm transform transition-all duration-200 ease-in-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-plus mr-2"></i>
                            Create Course
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Information supplémentaire -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                All fields except image are required. Make sure to provide clear and detailed information.
            </p>
        </div>
    </main>

    <script>
        // Script pour améliorer l'expérience utilisateur
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });
    </script>
</body>
</html>