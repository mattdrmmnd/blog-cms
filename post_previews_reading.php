<?php
$pageTitle = 'Matt The Dev - What I\'m Reading';
$activePage = 'reading';
$bodyClass = 'flex flex-col min-h-screen font-instrument text-white';

require __DIR__ . '/includes/head.php';
?>

    <!--Footer - flex-1 used in conjuction with body flex to push content downward-->
    <!--footer must be under this div-->
    <div class="flex-1">

    <?php require __DIR__ . '/includes/header.php'; ?>
      
      <section class="flex flex-col max-w-2xl mx-auto mt-3 px-12 sm:px-5">

        <h1 class="sr-only">What I'm reading</h1>
           
              <div class="flex flex-col mt-4 m-auto pb-17">
                  
                  <div class="">
                    <h2 class="font-semibold text-xl text-xlight-purple hover:text-white tracking-wider">
                      <a href="https://abraham-hicks.com/the-art-of-allowing-book/" target="_blank">
                      <span class="material-symbols-outlined text-white">
                        call_made
                      </span> 
                      The Art of Allowing</a>
                    </h2>
                    <p class="text-sm mt-2 pb-4">Dec 8, 2026</p>
                  </div>
                  
                  <div>
                    <p class="text-base sm:text-md max-w-lg border-l border-solid border-xlight-purple pl-5 ml-5 leading-10 tracking-wider">
                      <i>
                        Humanity is vast, but the subjects that occupy people’s attention are surprisingly few. Across cultures and generations, people return to the same essential questions, and in their first new book in over a decade, Esther and Jerry Hicks present new Teachings of Abraham to help answer them.
                      </i>
                    </p>
                  </div>
              
                  <p class="text-base mt-10 max-w-lg leading-10 tracking-wider">
                   I'm really looking forward to reading this book on Dec 8th. It's a self-help read by #1 New York Times best-selling authors, Ester and Jerry Hicks. It follows in a series of books that focus on Law of Attraction. This one reminds us that you get what you think about and how to tune into your desires. I'll update this passage once I've finished the book ! 
                  </p>
                  
                  <div class="flex flex-row gap-2 justify-end items-center mt-5">
                     <a href="https://abraham-hicks.com/the-art-of-allowing-book/"  aria-label="Read more: The Art of Allowing" target="_blank" class="flex text-xlight-purple hover:text-white gap-1">Read more 
                    <span class="material-symbols-outlined text-white">
                        call_made
                    </span> 
                  </a>
                  </div>
              </div>
      </section>

  </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
