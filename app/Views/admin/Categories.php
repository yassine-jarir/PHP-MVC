<?php
// Views/admin/course.php
use App\Services\AuthService;
use App\Services\Controllers;
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
    <title>Manage Categories - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <a href="../pages/admin/dashboard.php" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-lg">← Back to Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Manage Categories</h1>

        <!-- Success and Error Messages -->
      

         <!-- Add New Category Form -->
         <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-lg text-white mb-8 transform transition-all duration-300 hover:shadow-xl">
            <h2 class="text-xl font-semibold mb-4"><i class="fas fa-plus-circle mr-2"></i>Add New Category</h2>
            <form method="POST" action="/createCategories">
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="category_name">
                        Category Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                           id="category_name" type="text" name="name" required>
                </div>
                <button type="submit" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-300">
                    <i class="fas fa-save mr-2"></i>Add Category
                </button>
            </form>
        </div>
     
         <!-- Existing Categories List -->
         <div class="bg-white shadow-md rounded-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl">
            <h2 class="text-xl font-semibold p-6 border-b"><i class="fas fa-list-alt mr-2"></i>Existing Categories</h2>
            <div class="p-6">
                <ul class="space-y-2">
                    <?php foreach ($categories as $category): ?>
                        <li class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                            <span class="text-gray-700 font-medium"><?php echo htmlspecialchars($category['name']); ?></span>
                            <a href="?delete_id=<?php echo $category['id']; ?>" 
                               class="text-red-500 hover:text-red-700 transition duration-300">
                                <i class="fas fa-trash"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    
</body>
</html>