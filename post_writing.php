<?php
$bodyClass = 'flex flex-col min-h-screen font-inter text-white';

require_once __DIR__ . '/includes/dbh.inc.php';
require_once __DIR__ . '/includes/posts_model.inc.php';
require_once __DIR__ . '/includes/posts_view.inc.php';

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$post = $id ? get_published_post($pdo, $id) : null;

if (!$post) {
      http_response_code(404);
      die("Post not found.");
}

$pageTitle = $post["title"] . ' - Matt The Dev';

$pageDescription = post_excerpt($post["body"], 155);

$paragraphs = preg_split('/\R{2,}/', $post["body"]);

$morePosts = get_more_posts($pdo, $post["id"]);

require __DIR__ . '/includes/head.php';

?>

    <!--Footer - flex-1 used in conjuction with body flex to push content downward-->
    <!--footer must be under this div-->
    <div class="flex-1">

    <?php require __DIR__ . '/includes/header.php'; ?>
      
    <section class="flex flex-col max-w-2xl mx-auto mt-3 px-12 sm:px-5">
      <div class="flex flex-col mt-4 m-auto pb-17">

        <div class="">
          <h2 class="font-semibold text-2xl sm:text-large text-xlight-purple tracking-wider">
              <?= htmlspecialchars($post["title"]) ?>
          </h2>
          <p class="text-sm mt-2 pb-1"><?= date('M j, Y', strtotime($post["published_at"])) ?></p>
          <p class="text-sm mt-2 pb-4">Written by <span class="text-xlight-purple"><?= htmlspecialchars($post["display_name"] ?? 'Matt The Dev') ?></span>.</p>
        </div>

        <?php if ($post["featured_image"]): ?>
          <img src="<?= BASE_URL ?>public/uploads/blog/<?= htmlspecialchars($post["featured_image"]) ?>" alt="<?= htmlspecialchars($post["featured_image_alt"] ?? '') ?>" />

          <?php if ($post["featured_image_caption"]): ?>
            <p class="text-sm text-gray-400 mt-1 text-center">
              <?= htmlspecialchars($post["featured_image_caption"]) ?>
            </p>
          <?php endif; ?>
          
        <?php endif; ?>

        
        <?php foreach ($paragraphs as $paragraph): ?>

          <p class="text-xl mt-4 max-w-xl tracking-wide pb-8 leading-10">
            <?= nl2br(htmlspecialchars($paragraph)) ?>
          </p>

        <?php endforeach; ?>
      
      </div>
    </section>

    <section class="flex flex-col max-w-2xl mx-auto mt-3 pb-27 px-12">
      <div class="flex flex-row gap-2 items-center pb-12 tracking-wider">
        <p>Share:</p>
        <img src="<?= BASE_URL ?>public/images/share_icon.svg" class="h-6 pt-1 cursor-pointer" id="share-icon" />
      </div>

      <!--Toast Message--> 
      <div id="share-toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-orange-200 text-darkest-purple px-4 py-2 rounded-md opacity-0 pointer-events-none transition-opacity duration-300">
      </div>

      <?php if ($morePosts): ?>
        <h3 class="uppercase font-bold tracking-wider pb-6">More Posts</h3>
        <ul>
          
          <?php foreach ($morePosts as $morePost): ?>

            <li class="flex flex-col sm:flex-row justify-between border-b-[0.25px] border-solid border-gray-800 py-4">
              <a href="<?= BASE_URL ?>post_writing.php?id=<?= $morePost["id"] ?>">
                
                <p class="text-xlight-purple hover:text-light-purple text-xl">
                  <?= htmlspecialchars($morePost["title"]) ?>
                </p>
              
              </a>
              
              <p class="text-md"><?= date('M j, Y', strtotime($morePost["published_at"])) ?></p>
            </li>

          <?php endforeach; ?>

        </ul>
      <?php endif; ?>

    </section>
  </div>

    <script>
      const shareIcon = document.getElementById('share-icon');
      const toast = document.getElementById('share-toast');

      function showToast(message) {
        toast.textContent = message;
        toast.classList.remove('opacity-0');
        toast.classList.add('opacity-100');
        setTimeout(() => {
          toast.classList.remove('opacity-100');
          toast.classList.add('opacity-0');
        }, 2000);
      }

      shareIcon.addEventListener('click', async () => {
        const shareData = {
          title: document.title,
          url: window.location.href,
        };
        
        // If the browser supports the Web Share API
        if (navigator.share) { 

        // .share connects to the OS's default share options aka (Share Sheet).
        // .share is also called the Web Share API
          try {
            // Wait to see if user picks something or dismisses it
            await navigator.share(shareData);
          } catch (err) {
            // If the user cancels the share sheet, do nothing
            if (err.name !== 'AbortError') console.error(err);
          }
        } else {
          try {
            await navigator.clipboard.writeText(window.location.href);
            showToast('Link copied');
          } catch (err) {
            // Log error instead of letting it fail in silence
            console.error('Copy failed:', err);
          }
        }
      });
    </script>

<?php require __DIR__ . '/includes/footer.php'; ?>
