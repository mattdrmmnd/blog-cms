<?php

declare(strict_types=1);

function get_blog_posts(object $pdo, bool $trashed = false): array
{
    $condition = $trashed ? 'IS NOT NULL' : 'IS NULL';
    
    $query = "SELECT blog_posts.id, title, blog_posts.created_at, blog_posts.trashed_at, users.username, status FROM blog_posts LEFT JOIN  users ON users.id = blog_posts.user_id WHERE blog_posts.trashed_at $condition ORDER BY blog_posts.created_at DESC;";
    
    $stmt = $pdo->query($query);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
// ?array because this returns null when no post is found
function get_blog_post(object $pdo, int $id): ?array
{

    $query = "SELECT id, title, body, status, featured_image, featured_image_alt, featured_image_caption FROM blog_posts WHERE id = :id AND trashed_at IS NULL;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected  
    $stmt->execute();

    $post = $stmt->fetch();
    return $post ?: null;

}

function trash_blog_post(object $pdo, int $id): int
{
    $query = "UPDATE blog_posts SET trashed_at = NOW() WHERE id = :id AND trashed_at IS NULL;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->execute();

    return $stmt->rowCount();
}

function restore_blog_post(object $pdo, int $id): int
{
    $query = "UPDATE blog_posts SET trashed_at = NULL WHERE id = :id AND trashed_at IS NOT NULL;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->execute();

    return $stmt->rowCount();
}

function delete_blog_post(object $pdo, int $id): int
{
    $query = "DELETE FROM blog_posts WHERE id = :id AND trashed_at IS NOT NULL;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->execute();

    return $stmt->rowCount();
}

function get_blog_post_image(object $pdo, int $id): ?string
{
    $query = "SELECT featured_image FROM blog_posts WHERE id = :id AND trashed_at IS NOT NULL;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->execute();

    $image = $stmt->fetchColumn();
    return $image ?: null;
}

function create_blog_post(object $pdo, int $userId, string $title, string $body, string $status, ?string $featured_image, ?string $featured_image_alt, ?string $featured_image_caption): int
{
    $publishedAt = $status === 'published' ? 'NOW()' : 'NULL';

    $query = "INSERT INTO blog_posts (user_id, title, body, status, published_at, featured_image, featured_image_alt, featured_image_caption) VALUES (:user_id, :title, :body, :status, $publishedAt, :featured_image, :featured_image_alt, :featured_image_caption);";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":body", $body);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":featured_image", $featured_image);
    $stmt->bindParam(":featured_image_alt", $featured_image_alt);
    $stmt->bindParam(":featured_image_caption", $featured_image_caption);
    $stmt->execute();

    return (int) $pdo->lastInsertId();
}

function update_blog_post(object $pdo, int $id, string $title, string $body, string $status, ?string $featured_image, ?string $featured_image_alt, ?string $featured_image_caption): void
{
    $publishedAt = $status === 'published' ? ', published_at = COALESCE(published_at, NOW())' : '';

    $query = "UPDATE blog_posts SET title = :title, body = :body, status = :status$publishedAt, featured_image = :featured_image, featured_image_alt = :featured_image_alt, featured_image_caption = :featured_image_caption  WHERE id = :id AND trashed_at IS NULL";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":body", $body);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":featured_image", $featured_image);
    $stmt->bindParam(":featured_image_alt", $featured_image_alt);
    $stmt->bindParam(":featured_image_caption", $featured_image_caption);
    $stmt->execute();
}

function get_published_post(object $pdo, int $id): ?array 
{
    $query = "SELECT blog_posts.id, title, body, blog_posts.published_at, featured_image, featured_image_alt, featured_image_caption, users.display_name FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE blog_posts.id = :id AND status = 'published' AND trashed_at IS NULL;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->execute();

    $post = $stmt->fetch();
    return $post ?: null;
}

function get_published_posts(object $pdo): array 
{
    $query = "SELECT id, title, body, published_at, featured_image, featured_image_alt, featured_image_caption FROM blog_posts WHERE status = 'published' AND trashed_at IS NULL ORDER BY published_at DESC;";

    $stmt = $pdo->query($query);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_more_posts(object $pdo, int $id): array
{
    $query = "SELECT id, title, published_at FROM blog_posts WHERE trashed_at IS NULL AND id != :id AND status = 'published' ORDER BY published_at DESC LIMIT 4;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Use PARAM_INT whenever a number is expected
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

