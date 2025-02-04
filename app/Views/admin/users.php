<?php
// require_once '../config/config.php';
// require_once '../classes/Admin.php';

// session_start();

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header('Location: ../login.php');
//     exit;
// }

// $database = Database::getInstance();
// $db = $database->connect();
// $admin = new Admin($db);

// $users = $admin->getAllUsers();

// // Handle user actions
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['toggle_status'])) {
//         $admin->toggleUserStatus($_POST['user_id']);
//     } elseif (isset($_POST['verify_teacher'])) {
//         $admin->verifyTeacher($_POST['user_id']);
//     }
//     header('Location: users.php');
//     exit;
// }

// 

 $user = $fetchAllUsers;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <a href="admin/dashboard" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-lg">← Back to Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Student Management</h1>

        <!-- Success and Error Messages -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 animate-fade-in" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['success_message']; ?></span>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 animate-fade-in" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['error_message']; ?></span>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

      <!-- User Table -->
      <div class="bg-white shadow-md rounded-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                         <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($fetchAllUsers as $user): ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['role']); ?></td>
                             
                            <td class="px-6 py-4 whitespace-nowrap">   
                              
                              

                               

                                <!-- Delete Button -->
                                <button onclick="confirmDelete(<?php echo $user['id']; ?>)" class="text-sm text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                window.location.href = 'delete-user.php?id=' + userId;
            }
        }
    </script>
   
</body>
</html>