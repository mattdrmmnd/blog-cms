<?php
$pageTitle = 'ADMIN - Blog Posts';
$bodyClass = 'flex flex-col min-h-screen font-instrument text-white';
$activePage = 'posts_blog';

require_once __DIR__ . '/../includes/auth.inc.php';
require_once __DIR__ . '/../includes/dbh.inc.php';
require_once __DIR__ . '/../includes/posts_model.inc.php';

$isTrash = ($_GET['view'] ?? '') === 'trash';
$posts = get_blog_posts($pdo, $isTrash);

require __DIR__ . '/../includes/head.php';
?>

    <div class="flex-1 relative z-10 flex flex-col">

        <?php require __DIR__ . '/../includes/admin_header.php'; ?>

        <div class="flex flex-col sm:flex-row flex-1 max-w-5xl mx-auto w-full px-5 gap-6 pb-10">

            <?php require __DIR__ . '/../includes/admin_sidebar.php'; ?>

            <!-- Main content -->
            <main class="flex-1 min-w-0 mt-5">

                <section class="flex items-center justify-between mb-5">
                    
                    <div class="flex flex-col tracking-wider">
                        <h1 class="font-normal text-lg tracking-wider"><?= $isTrash ? 'Trash - Blog' : 'Posts - Blog' ?></h1>

                        <nav aria-label="Post views" class="flex gap-2 text-xs mt-1">

                            <p>View:</p>
                            <a href="<?= BASE_URL ?>admin/posts_blog.php" <?= !$isTrash ? 'aria-current="page"' : '' ?> class="aria-[current=page]:text-xlight-purple aria-[current=page]:font-semibold transition-colors">All posts</a>

                            <span aria-hidden="true" class="text-gray-500">|</span>
                            
                            <a href="<?= BASE_URL ?>admin/posts_blog.php?view=trash" <?= $isTrash ? 'aria-current="page"' : '' ?> class="aria-[current=page]:text-xlight-purple aria-[current=page]:font-semibold transition-colors">Trashed</a>
                            
                        </nav>

                    </div>
                        
                    

                    <a href="<?= BASE_URL ?>admin/posts_blog_form.php" class="inline-flex items-center gap-1 bg-dark-purple hover:bg-light-purple/80 transition-colors text-sm font-semibold px-4 py-2 rounded-sm tracking-wider">
                        <span aria-hidden="true">+</span> Add Post
                    </a>
                </section>

                <section class="bg-black/50 rounded-2xl p-7 overflow-x-auto">

                    <?php 
                        if (isset($_SESSION["posts_message"])) {
                            echo '<p class="mb-4 text-sm text-orange-200 tracking-wider" role="status">' . htmlspecialchars($_SESSION["posts_message"]) . '</p>';

                            unset($_SESSION["posts_message"]);
                        }
                    ?>

                    <table class="w-full text-sm text-left border-collapse tracking-wider">
                        <caption class="sr-only">List of blog posts</caption>
                        <thead>
                            <tr class="text-gray-400 border-b border-white/10">
                                <th scope="col" class="pb-3 pr-4 font-normal">Title</th>
                                <th scope="col" class="pb-3 pr-4 font-normal">Author</th>
                                <th scope="col" class="pb-3 font-normal">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">

                            <?php if (empty($posts)): ?>
                                
                                <tr>
                                    <td colspan="3" class="py-3">
                                        <?= $isTrash ? 'Trash is empty.' : 'No posts yet.' ?>
                                    </td>
                                </tr>

                            <?php else: ?>

                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td class="py-3 pr-4">

                                        <p><?= htmlspecialchars($post['title']) ?></p>

                                        <?php if ($isTrash): ?>
                                        
                                        <div class="flex gap-2 text-xs mt-1">

                                            <form action="<?= BASE_URL ?>admin/posts_blog_restore.php" method="post" class="inline">

                                                <?php csrf_field(); ?>

                                                <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
                                                <button type="submit" class="text-green-400 hover:text-white transition-colors" aria-label="Restore: <?= htmlspecialchars($post['title']) ?>">Restore</button>

                                            </form>

                                            <span aria-hidden="true" class="text-gray-500">|</span>

                                            <form action="<?= BASE_URL ?>admin/posts_blog_delete.php" method="post" class="inline">

                                                <?php csrf_field(); ?>

                                                <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
                                                <button type="submit" data-confirm="Are you sure you want to DELETE this post?" class="text-red-300 hover:text-white transition-colors" aria-label="Delete permanently: <?= htmlspecialchars($post['title']) ?>">Delete</button>

                                            </form>

                                            

                                        </div>    

                                        <?php else: ?>

                                        <div class="flex gap-2 text-xs mt-1">
                                            <a href="<?= BASE_URL ?>admin/posts_blog_form.php?id=<?= htmlspecialchars($post['id']) ?>" class="text-light-purple hover:text-white transition-colors">Edit</a>

                                            <span aria-hidden="true" class="text-gray-500">|</span>

                                            <form action="<?= BASE_URL ?>admin/posts_blog_trash.php" method="post" class="inline">

                                                <?php csrf_field(); ?>

                                                <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
                                                <button type="submit" class="text-red-300 hover:text-white transition-colors" aria-label="Trash: <?= htmlspecialchars($post['title']) ?>">Trash</button>

                                            </form>

                                            
                                            
                                            <?php if ($post["status"] === 'published'):  ?>
                                                
                                                <span aria-hidden="true" class="text-gray-500">|</span>
                                                
                                                <form action="<?= BASE_URL ?>admin/posts_blog_pin.php" method="post" class="inline">

                                                    <?php csrf_field(); ?>

                                                    <input type="hidden" name="action" value="<?= $post["pinned_at"] ? 'unpin' : 'pin' ?>">
                                                    <input type="hidden" name="id" value="<?= $post["id"] ?>">

                                                    <button type="submit" class="text-gray-400 hover:text-white transition-colors" aria-label="<?= $post["pinned_at"] ? 'Unpin' : 'Pin' ?>: <?= htmlspecialchars($post['title']) ?>"><?= $post["pinned_at"] ? 'Unpin' : 'Pin' ?></button>

                                                </form>
                                            <?php endif; ?>

                                        </div>

                                        <?php endif; ?>
                                        
                                    </td>
                                    <td class="py-3 pr-4"><?= htmlspecialchars($post['display_name'] ?? 'Unknown') ?></td>
                                    <td class="py-3">
                                        <p><?= htmlspecialchars(ucfirst($post['status'])) ?></p>
                                        <p class="text-xs text-gray-400"><?= date('Y/m/d \a\t g:i a', strtotime($post['created_at'])) ?></p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>

            </main>

        </div>
    </div>

<?php require __DIR__ . '/../includes/footer.php'; ?>
