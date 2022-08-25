# Refactoring Exercise

## Setup

```php
git clone git@github.com:yceruto/solid-php.git
cd solid-php
composer install
php -S 127.0.0.1:8000 -t public/
```

## Specifications

 * `/<legacy|app>/blog-post/new.php`: The blog post is created.
 * `/<legacy|app>/blog-post/edit.php?id=1`: The blog post is edit.
 * `/<legacy|app>/blog-post/show.php?id=1`: The blog post is showed.
 * `/<legacy|app>/blog-post/list.php`: All blog posts are listed.
 * The blog post is saved in storage upon creation or edition.
 * The blog post is loaded from storage during showing action.
 * The blog post is rendered in a given format (e.g. `/<legacy|app>/blog-post/show.php?id=1&format=json`) html by default.

Note: Use `https://loripsum.net/api/1/long/headers` endpoint to generate random content.

A version has been implemented under `src/Legacy/` directory with many violations of the SOLID principles.

## Task 1

Re-create the application under the `src/App` and `public/app/` directories using the refactoring techniques.

Take into account the following specification during the refactoring:
 * A new storage could be added to support Redis, MongoDB or any other NoSQL database.
 * A new format could be added to support XML and TXT.

Note: Create a new branch from master and send your solution in a new PR here, so we can discuss it between us.

## Task 2

Refactor splitting the code into 4 layers, Presentation, Application, Domain, and Infrastructure.
