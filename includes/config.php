<?php

// The URL path the site is served from by Apache (http://localhost/blog-cms/)
// Use it to build links and asset paths that work from any folder, e.g. admin/
// /blog-cms/ on localhost (XAMPP), / everywhere else (the live site at the domain root)

// ?? '' Gives an empty string instead of a warning if key is missing
$isLocal = ($_SERVER["HTTP_HOST"] ?? '') === 'localhost';

define('BASE_URL', $isLocal ? '/blog-cms/' : '/');
