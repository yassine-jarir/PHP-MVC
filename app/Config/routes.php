<?php

use App\Controllers\AuthController;
use App\Controllers\CourseController; // Ajout de l'import manquant
use App\Controllers\CategoriesController; // Ajout de l'import manquant

// Routes d'authentification
$router->get('/login', [AuthController::class, 'showLoginPage']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/signup', [AuthController::class, 'showSignupPage']);
$router->post('/signup', [AuthController::class, 'signup']);
$router->get('/user/dashboard', [AuthController::class, 'dashboard']);
$router->get('/admin/dashboard', [AuthController::class, 'dashboard']);
$router->get('/studentManage', [AuthController::class, 'users']);
$router->get('/logout', [AuthController::class, 'logout']);

// Correction ici : utilisation de CourseController au lieu de AuthController
$router->get('/course', [CourseController::class, 'getAllCourses']);
$router->get('/categories', [CategoriesController::class, 'displaycategories']);
$router->post('/createCategories', [CategoriesController::class, 'ajouterCategorie']);

// Dans votre fichier de routes
 
// Routes pour les cours
// $router->get('/admin/courses', [CourseController::class, 'adminDashboard']);
// $router->get('/courses', [CourseController::class, 'listCourses']);
$router->post('/admin/course/add', [CourseController::class, 'addCourse']);
// $router->get('/admin/course/edit/:id', [CourseController::class, 'showEditForm']);
// $router->post('/admin/course/update', [CourseController::class, 'updateCourse']);
// $router->post('/admin/course/delete', [CourseController::class, 'deleteCourse']);
// $router->get('/course/:id', [CourseController::class, 'getCourse']);

// $router->get('/admin/course/add', [CourseController::class, 'showAddForm']);
// $router->post('/admin/course/add', [CourseController::class, 'addCourse']);