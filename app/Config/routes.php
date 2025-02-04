<?php
 
use App\Controllers\AuthController;

$router->get('/login', [AuthController::class, 'showLoginPage']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/signup', [AuthController::class, 'showSignupPage']);
$router->post('/signup', [AuthController::class, 'signup']);
$router->get('/user/dashboard', [AuthController::class, 'dashboard']);
$router->get('/admin/dashboard', [AuthController::class, 'dashboard']);

$router->get('/logout', [AuthController::class, 'logout']);
