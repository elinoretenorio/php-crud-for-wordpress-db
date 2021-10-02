<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", WordPress\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// WpCommentmeta

$container->add("WpCommentmetaRepository", WordPress\WpCommentmeta\WpCommentmetaRepository::class)
    ->addArgument("Database");
$container->add("WpCommentmetaService", WordPress\WpCommentmeta\WpCommentmetaService::class)
    ->addArgument("WpCommentmetaRepository");
$container->add(WordPress\WpCommentmeta\WpCommentmetaController::class)
    ->addArgument("WpCommentmetaService");

// WpComments

$container->add("WpCommentsRepository", WordPress\WpComments\WpCommentsRepository::class)
    ->addArgument("Database");
$container->add("WpCommentsService", WordPress\WpComments\WpCommentsService::class)
    ->addArgument("WpCommentsRepository");
$container->add(WordPress\WpComments\WpCommentsController::class)
    ->addArgument("WpCommentsService");

// WpLinks

$container->add("WpLinksRepository", WordPress\WpLinks\WpLinksRepository::class)
    ->addArgument("Database");
$container->add("WpLinksService", WordPress\WpLinks\WpLinksService::class)
    ->addArgument("WpLinksRepository");
$container->add(WordPress\WpLinks\WpLinksController::class)
    ->addArgument("WpLinksService");

// WpOptions

$container->add("WpOptionsRepository", WordPress\WpOptions\WpOptionsRepository::class)
    ->addArgument("Database");
$container->add("WpOptionsService", WordPress\WpOptions\WpOptionsService::class)
    ->addArgument("WpOptionsRepository");
$container->add(WordPress\WpOptions\WpOptionsController::class)
    ->addArgument("WpOptionsService");

// WpPostmeta

$container->add("WpPostmetaRepository", WordPress\WpPostmeta\WpPostmetaRepository::class)
    ->addArgument("Database");
$container->add("WpPostmetaService", WordPress\WpPostmeta\WpPostmetaService::class)
    ->addArgument("WpPostmetaRepository");
$container->add(WordPress\WpPostmeta\WpPostmetaController::class)
    ->addArgument("WpPostmetaService");

// WpPosts

$container->add("WpPostsRepository", WordPress\WpPosts\WpPostsRepository::class)
    ->addArgument("Database");
$container->add("WpPostsService", WordPress\WpPosts\WpPostsService::class)
    ->addArgument("WpPostsRepository");
$container->add(WordPress\WpPosts\WpPostsController::class)
    ->addArgument("WpPostsService");

// WpTermRelationships

$container->add("WpTermRelationshipsRepository", WordPress\WpTermRelationships\WpTermRelationshipsRepository::class)
    ->addArgument("Database");
$container->add("WpTermRelationshipsService", WordPress\WpTermRelationships\WpTermRelationshipsService::class)
    ->addArgument("WpTermRelationshipsRepository");
$container->add(WordPress\WpTermRelationships\WpTermRelationshipsController::class)
    ->addArgument("WpTermRelationshipsService");

// WpTermTaxonomy

$container->add("WpTermTaxonomyRepository", WordPress\WpTermTaxonomy\WpTermTaxonomyRepository::class)
    ->addArgument("Database");
$container->add("WpTermTaxonomyService", WordPress\WpTermTaxonomy\WpTermTaxonomyService::class)
    ->addArgument("WpTermTaxonomyRepository");
$container->add(WordPress\WpTermTaxonomy\WpTermTaxonomyController::class)
    ->addArgument("WpTermTaxonomyService");

// WpTermmeta

$container->add("WpTermmetaRepository", WordPress\WpTermmeta\WpTermmetaRepository::class)
    ->addArgument("Database");
$container->add("WpTermmetaService", WordPress\WpTermmeta\WpTermmetaService::class)
    ->addArgument("WpTermmetaRepository");
$container->add(WordPress\WpTermmeta\WpTermmetaController::class)
    ->addArgument("WpTermmetaService");

// WpTerms

$container->add("WpTermsRepository", WordPress\WpTerms\WpTermsRepository::class)
    ->addArgument("Database");
$container->add("WpTermsService", WordPress\WpTerms\WpTermsService::class)
    ->addArgument("WpTermsRepository");
$container->add(WordPress\WpTerms\WpTermsController::class)
    ->addArgument("WpTermsService");

// WpUsermeta

$container->add("WpUsermetaRepository", WordPress\WpUsermeta\WpUsermetaRepository::class)
    ->addArgument("Database");
$container->add("WpUsermetaService", WordPress\WpUsermeta\WpUsermetaService::class)
    ->addArgument("WpUsermetaRepository");
$container->add(WordPress\WpUsermeta\WpUsermetaController::class)
    ->addArgument("WpUsermetaService");

// WpUsers

$container->add("WpUsersRepository", WordPress\WpUsers\WpUsersRepository::class)
    ->addArgument("Database");
$container->add("WpUsersService", WordPress\WpUsers\WpUsersService::class)
    ->addArgument("WpUsersRepository");
$container->add(WordPress\WpUsers\WpUsersController::class)
    ->addArgument("WpUsersService");

