<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    csrf_verify();
    
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    $action = $_POST["action"] ?? '';

    // Guard Clause handles the failure first
    // Then main work isnt nested inside an if
    if ($id === false || $id === null) {
        
        header('Location: ' . BASE_URL . 'admin/posts_blog.php');
        die();
    }

    // Action Guard
    if (!in_array($action, ['pin', 'unpin'], true)) {
      
        header('Location: ' . BASE_URL . 'admin/posts_blog.php');
        die();
    }

    require_once __DIR__ . '/../includes/dbh.inc.php';
    require_once __DIR__ . '/../includes/posts_model.inc.php';

    
    if ($action === 'pin') {
        $changed = pin_blog_post($pdo, $id);
    } else {
        $changed = unpin_blog_post($pdo, $id);
    }

    if ($action === 'pin' && $changed === 1) {
        $_SESSION["posts_message"] = 'Post pinned.';

    } elseif ($action === 'unpin' && $changed === 1) {
        $_SESSION["posts_message"] = 'Post unpinned.';
        
    } elseif ($action === 'pin' && $changed === 0) {
        $_SESSION["posts_message"] = 'Only published posts can be pinned.';
    
    } else {
        $_SESSION["posts_message"] = "Post isn't pinned.";
    }

    header('Location: ' . BASE_URL . 'admin/posts_blog.php');
    die();
}
// For non-POST visits
header('Location: ' . BASE_URL . 'admin/posts_blog.php');
exit;