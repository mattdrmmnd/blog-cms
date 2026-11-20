<?php

declare(strict_types=1);

// Holds formatting helpers shared by the public post pages

// Returns a one-line excerpt of a post body, at most $length characters plus "…".
// Plain text: escape it with htmlspecialchars() where it's printed.
function post_excerpt(string $body, int $length): string
{   
    // Turn every run of whitespace (line breaks, tabs, extra spaces) into one space
    $text = preg_replace('/\s+/', ' ', $body);
    
    // Short enough already: return it whole, with no …
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    
    // Cut to the max length
    $cut = mb_substr($text, 0, $length);

    // Back up to the last space so a word isn't cut in half (false when there's no space)
    $lastSpace = mb_strrpos($cut, ' ');

    if ($lastSpace !== false) {
        $cut = mb_substr($cut, 0, $lastSpace);
    }

    return $cut . '…';
}
