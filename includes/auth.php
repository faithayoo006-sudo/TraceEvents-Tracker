<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

function role_home(string $role): string {
    return match (strtoupper($role)) {
        'ORGANIZER'  => 'organizer.php',
        'MANAGEMENT' => 'management.php',
        default      => 'events.php',
    };
}

function require_role(string $required_role): void {
    if (!is_logged_in() || strtoupper($_SESSION['role'] ?? '') !== strtoupper($required_role)) {
        header('Location: index.php?error=unauthorized');
        exit;
    }
}

function e(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?>
