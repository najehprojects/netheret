<?php
session_start();
if(session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

function requireLogin(): void{
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    }
}

function requireRole(string $role): void{
    requireLogin();
    if (($_SESSION['role'] ?? '') !== $role){
        http_response_code(403);
        exit('Access denied.');
    }
}