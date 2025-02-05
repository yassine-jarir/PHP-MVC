<?php
// require_once '../config/config.php';
// require_once '../classes/User.php';
// require_once '../classes/CourseText.php';
// require_once '../classes/CourseVideo.php';
// require_once '../classes/CourseVideo.php';
use App\Services\AuthService;
$userRole = AuthService::isAuthenticated();

if (!$userRole === 'admin') {
    // echo "JWT Cookie not set!";
    header('Location: login.php');
}

// session_start();

// Redirect to login if the user is not logged in
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit;
// }

// // Use Singleton to get the database instance
// $database = Database::getInstance();
// $db = $database->getConnection();

// $course = new CourseText($db);
// $course = new CourseVideo($db);

// $role = $_SESSION['role'];
// $is_verified = $_SESSION['is_verified'] ?? false; // Use null coalescing operator to avoid undefined key warning

// // Redirect teachers who are not verified
// if ($role === 'teacher' && $is_verified == 0) {
//     header("Location: waiting-for-verification.php");
//     exit();
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-gradient-to-r from-indigo-800 to-purple-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="../index.php" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-white text-2xl">Youdemy</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="/logout" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Welcome to Your Dashboard</h1>

        
            <!-- Admin Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="text-center">
                        <i class="fas fa-users text-5xl text-blue-500 mb-4"></i>
                        <h2 class="text-xl font-semibold mb-4">Student Management</h2>
                        <a href="/studentManage" class="text-blue-500 hover:text-blue-700">Manage Students →</a>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="text-center">
                        <i class="fas fa-tags text-5xl text-purple-500 mb-4"></i>
                        <h2 class="text-xl font-semibold mb-4">Categories Management</h2>
                        <a href="../admin/categories.php" class="text-blue-500 hover:text-blue-700">Manage Categories →</a>
                    </div>
                </div>
               
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="text-center">
                        <i class="fas fa-chart-line text-5xl text-red-500 mb-4"></i>
                        <h2 class="text-xl font-semibold mb-4">Statistics Management</h2>
                        <a href="../admin/statistics.php" class="text-blue-500 hover:text-blue-700">View Statistics →</a>
                    </div>
                </div>
                <!-- New Courses Management Section -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="text-center">
                        <i class="fas fa-book text-5xl text-green-500 mb-4"></i>
                        <h2 class="text-xl font-semibold mb-4">Courses Management</h2>
                        <a href="/Course" class="text-blue-500 hover:text-blue-700">Validate Courses →</a>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>