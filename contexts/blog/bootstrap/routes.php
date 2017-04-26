<?php
// Application Routes

/* *** WordPress *** */

// List all posts
$app->get('/', \erdiko\wordpress\controllers\Posts::class);

// Get Author
$app->get('/author/{author}', \erdiko\wordpress\controllers\Author::class);

// Get Bookmarks
// $app->get('/bookmarks', \erdiko\wordpress\controllers\Bookmarks::class);

// Get Bookmarks by category
// $app->get('/bookmarks/{category}', \erdiko\wordpress\controllers\Bookmarks::class);

// Get Posts by category
$app->get('/category/{category}', \erdiko\wordpress\controllers\Category::class);

// Get Posts by category
$app->get('/tag/{tag}', \erdiko\wordpress\controllers\Tag::class);

// Get Post
$app->get('/post/{post_url}', \erdiko\wordpress\controllers\Content::class);

// Get Post
$app->get('/{year:[0-9]{4}}/{month}/{name}[/]', \erdiko\wordpress\controllers\Content::class);

// Get Post/Page
$app->get('/{post_url}', \erdiko\wordpress\controllers\Content::class);
