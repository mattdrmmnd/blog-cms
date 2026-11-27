<?php
$pageTitle = 'Matt Drummond - Full-Stack Developer | Matt The Dev';

$pageDescription = 'Full-stack web developer Matt Drummond writes about building secure three-tier web apps with PHP, MySQL and TypeScript.';

$bodyClass = 'home flex flex-col min-h-screen bg-cover bg-center bg-fixed font-instrument text-white';

require_once __DIR__ . '/includes/dbh.inc.php';
require_once __DIR__ . '/includes/posts_model.inc.php';

$recentPosts = get_recent_posts($pdo);

require __DIR__ . '/includes/head.php';
?>

     <!--To Top Gradient for background-->
    <div class="fixed inset-0 top-[30vh] bg-linear-to-t from-[#0C0C0C] from-50% to-transparent to-100%"></div>

    <!--Footer - flex-1 used in conjuction with body flex to push content downward-->
    <!--footer must be under this div-->
    <div class="flex-1 relative z-10">

    <?php require __DIR__ . '/includes/header.php'; ?>

    <section class="max-w-3xl mx-auto mt-3 px-5 py-3">
      <div class="w-full max-w-[725px] min-h-full bg-black/50 rounded-xl p-12 text-center">

        <h1 class="font-semibold text-3xl sm:text-4xl tracking-wider">Matt Drummond</h1>
        <p class="mt-5 font-normal text-lg sm:text-2xl tracking-wider"><span class="text-xlight-purple">Full-Stack</span> Web Developer</p>
        <p class="mt-3 font-normal text-lg sm:text-xl tracking-wider">Building Secure, <span class="text-xlight-purple">Database-Driven</span> Web Applications</p>

      </div>

      <div class="flex flex-col xmid:flex-row gap-10 xmid:gap-0 justify-between items-center px-16 py-10 min-h-full max-w-87 xmid:max-w-full bg-black/50 rounded-xl mt-12 mx-auto">
        

        <h2 class="font-semibold text-xl text-center text-xlight-purple tracking-wider">Visit Me:</h2>

        <a href="https://github.com/mattdrmmnd" target="_blank" rel="noopener noreferrer" aria-label="Visit Matt on GitHub">
          <img src="<?= BASE_URL ?>public/images/github_logo.svg" class="h-8 hover:opacity-50" />
        </a>

        <a href="https://x.com/itsmattdev" target="_blank" rel="noopener noreferrer" class="transition-colors hover:text-orange-200 text-xs" aria-label="Visit Matt's X profile.">
          <img src="<?= BASE_URL ?>public/images/x_logo.svg" alt="" class="h-8 hover:opacity-50" />
        </a>
    
        <a href="https://www.linkedin.com/in/mattdrummond" target="_blank" rel="noopener noreferrer" aria-label="Visit Matt on Linkedin">
          <img src="<?= BASE_URL ?>public/images/linkedin_logo.webp" class="h-8 hover:opacity-50" />
        </a>

       
      </div>
    </section>

    <section class="max-w-3xl mx-auto mt-12 px-7 sm:px-5">
      <div class="flex flex-col bg-black/50 rounded-xl p-7 sm:p-12">
        <h2 class="font-semibold text-md text-white tracking-wider">GitHub Activity</h2>
        <div class="mt-5 pb-6 overflow-x-auto border-b-[0.25px] border-solid border-gray-800" dir="rtl" role="region" aria-label="GitHub contribution graph">
          <a href="https://github.com/mattdrmmnd" target="_blank" rel="noopener noreferrer" class="block hover:opacity-80">
            <img src="https://ghchart.rshah.org/3E0058/mattdrmmnd" alt="Matt's GitHub contribution graph. Visit Matt on GitHub" class="min-w-[600px] w-full h-auto" />
          </a>
        </div>
        <a href="https://github.com/mattdrmmnd/blog-cms" target="_blank" rel="noopener noreferrer" class="self-center mt-4 text-xlight-purple hover:text-white tracking-wider">
          <span class="font-semibold text-white">Currently hacking on:</span> blog-cms
        </a>
      </div>
    </section>


    <section class="flex flex-col max-w-3xl mx-auto mt-3 px-7 sm:px-5">
            <div class="flex flex-col mt-4 m-auto pb-5 w-full max-w-[725px] min-h-full bg-black/50 rounded-xl p-7 sm:pl-25">

                <div class="flex flex-row items-center gap-4 mt-7">
                  
                  <img src="<?= BASE_URL ?>public/images/avatar.webp" alt="Matt's profile image: a Hand-drawn M and @ symbol" class="w-15 h-15 rounded-full object-cover" />
                  
                  <div>
                    <p class="text-lg tracking-wider"><b>Location: </b>The Valley, AZ USA</p>
                    <p class="text-md max-w-71 tracking-wider mt-1">Contact me: <a href="mailto:matt@optmzd.net" class="text-xlight-purple hover:text-white" rel="noopener noreferrer">matt@optmzd.net</a></p>
                  </div>
                  
                </div> 
                
                <div class="flex flex-col mt-7 pb-8 max-w-lg text-lg tracking-wider leading-10">
                  <p class="pb-8">Full-stack web developer and owner of OPTMZD. I build secure, database-driven web applications, from a custom PHP and MySQL blog CMS to modern front ends in TypeScript.</p>
                  <p class="pb-8">I designed and built this blog CMS from scratch in raw PHP and MySQL, with an authenticated admin panel and a public front end. Next, I'm rebuilding the OPTMZD company site in the TALL stack, followed by a SaaS MVP app, planned for spring.</p>
                  

                <div class="w-full max-w-lg min-h-full border-l-[0.25px] border-solid border-orange-200 ps-4">
                  <h2 class="font-normal text-xl tracking-wider pb-3 text-orange-200">Experience:</h2>

                  <div class="pb-5">
                    <p class="text-md sm:text-lg tracking-wider leading-10"><b>Full-Stack Web Developer, <a href="https://optmzd.net" class="text-xlight-purple hover:text-white" target="_blank" rel="noopener noreferrer">OPTMZD</a> (Owner)</b></p>
                    <p class="text-md text-gray-300 tracking-wider leading-10 ps-2">Building a blog CMS in raw PHP and MySQL with an authenticated admin panel. Next: the company site in the TALL stack, then a SaaS MVP product.</p>
                  </div>

                  <div class="pb-8">
                    <p class="text-md sm:text-lg tracking-wider leading-10"><b>Production Designer, <a href="https://sieb.com/" class="text-xlight-purple hover:text-white" target="_blank" rel="noopener noreferrer">SIEB</a> (2 years)</b></p>
                    <p class="text-md text-gray-300 tracking-wider leading-10 ps-2">Worked across visual design, email marketing, front-end development, and JavaScript web banners.</p>
                  </div>  
                </div>

                  <p class="mt-8">B.S., Digital Arts &amp; Design, 
                    <a href="https://www.fullsail.edu/degrees/digital-arts-design-bachelor-degree-program" class="text-xlight-purple hover:text-white" target="_blank" rel="noopener noreferrer">Full Sail University</a>.
                  </p>
                </div>

            </div>
    </section>

    <section class="flex flex-col max-w-3xl mx-auto px-7 sm:px-5">

            <div class="flex flex-col p-7 pt-12 pb-12 sm:pl-15 mt-12 bg-black/50 rounded-xl ">
              <h2 class="font-normal text-white text-xl sm:text-xl tracking-wider">
                  Skills
              </h2>


                <div class="grid grid-cols-autofit gap-5 tracking-wider pt-3 m-auto sm:m-0">
                  <div>
                  <h3 class="pb-2 underline">Front-End</h3>
                      <ul class="text-orange-100">
                          <li>CSS</li>
                          <li>HTML</li>
                          <li>Javascript</li>
                          <li>Tailwind</li>
                          <li>TypeScript</li>
                      </ul>
                  </div>
                  
                  <div>
                  <h3 class="pb-2 underline">Server-Side</h3>
                      <ul class="text-orange-100">
                          <li>MySQL</li>
                          <li>Node.js</li>
                          <li>PHP</li>
                      </ul>
                  </div>

                  <div>
                  <h3 class="pb-2 underline">Tools & Design</h3>
                      <ul class="text-orange-100">
                          <li>Adobe CC Pro</li>
                          <li>Figma</li>
                          <li>Git / GitHub</li>
                          <li>phpMyAdmin</li>
                          <li>Vite</li>
                          <li>Xampp</li>
                          
                      </ul>
                  </div>
                </div>
                
            </div>
            
    </section>

    <?php if ($recentPosts): ?>
      <section class="flex flex-col max-w-3xl mx-auto my-12 px-7 sm:px-5">
        
        <div class="px-12 sm:px-8 py-12 bg-black/50 rounded-xl">
          <h2 class="font-normal text-xl text-center text-white tracking-wider">Recent Posts</h2>

          <div class="flex flex-col max-w-2xl mx-auto mt-3 pb-8 px-12">
            <ul>
            
              <?php foreach ($recentPosts as $recentPost): ?>

                <li class="flex flex-col sm:flex-row justify-between border-b-[0.25px] border-solid border-gray-800 py-4">
                  <a href="<?= BASE_URL ?>post_writing.php?id=<?= $recentPost["id"] ?>">
                    
                    <div class="flex flex-row gap-1">

                      <?php if ($recentPost["pinned_at"]): ?>
                      <span class="material-symbols-outlined text-orange-200" aria-hidden="true">
                        keep
                      </span>
                      <span class="sr-only">Pinned:</span>
                      <?php endif; ?>

                      <p class="text-xlight-purple hover:text-light-purple text-xl">
                        <?= htmlspecialchars($recentPost["title"]) ?>
                      </p>
                    </div>
                  
                  </a>
                  
                  <p class="text-md"><?= date('M j, Y', strtotime($recentPost["published_at"])) ?></p>
                </li>

              <?php endforeach; ?>

            </ul>
          </div>

        </div>
          
      </section>
    <?php endif; ?>

  </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
