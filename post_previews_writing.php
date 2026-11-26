<?php
$pageTitle = 'Matt The Dev - What I\'m Writing';
$activePage = 'writing';
$bodyClass = 'flex flex-col min-h-screen font-instrument text-white';

require_once __DIR__ . '/includes/dbh.inc.php';
require_once __DIR__ . '/includes/posts_model.inc.php';
require_once __DIR__ . '/includes/posts_view.inc.php';


$posts = get_published_posts($pdo);

$pageDescription = "Posts about web development and related topics";

require __DIR__ . '/includes/head.php';
?>

  <!--Footer - flex-1 used in conjuction with body flex to push content downward-->
  <!--footer must be under this div-->
  <div class="flex-1 pb-8">
  
    <?php require __DIR__ . '/includes/header.php'; ?>
      
      <h1 class="sr-only">What I'm writing</h1>

      <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
        <section class="flex flex-col max-w-2xl mx-auto px-12 sm:px-5">
          <div class="flex flex-col pt-10 pb-10 border-b-[0.25px] border-solid border-gray-800 [section:last-of-type_&]:border-b-0">

            <div class="">
              <h2 class="font-normal text-xl text-xlight-purple hover:text-white tracking-wider">
                <a href="<?= BASE_URL ?>post_writing.php?id=<?= $post["id"] ?>"><?= htmlspecialchars($post["title"]) ?></a>
              </h2>
              <p class="text-sm mt-2"><?= date('M j, Y', strtotime($post["published_at"])) ?></p>
            </div>

            <p class="text-base mt-4 max-w-lg tracking-wider">
              <?= htmlspecialchars(post_excerpt($post["body"], 185)) ?> 
            </p>
            <a href="<?= BASE_URL ?>post_writing.php?id=<?= $post["id"] ?>" aria-label="More: <?= htmlspecialchars($post["title"]) ?>" class="text-xlight-purple hover:text-white mt-5 self-start">More</a>
          </div>
        </section>
        <?php endforeach; ?>
        
      <?php else: ?>
        <div class="max-w-2xl mx-auto px-12 sm:px-5 pt-10">
          <p>No posts yet.</p>
        </div>
      <?php endif ?>

  </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
