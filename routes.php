<?php

declare(strict_types=1);

$router->get("/wp-commentmeta", "WordPress\WpCommentmeta\WpCommentmetaController::getAll");
$router->post("/wp-commentmeta", "WordPress\WpCommentmeta\WpCommentmetaController::insert");
$router->group("/wp-commentmeta", function ($router) {
    $router->get("/{meta_id:number}", "WordPress\WpCommentmeta\WpCommentmetaController::get");
    $router->post("/{meta_id:number}", "WordPress\WpCommentmeta\WpCommentmetaController::update");
    $router->delete("/{meta_id:number}", "WordPress\WpCommentmeta\WpCommentmetaController::delete");
});

$router->get("/wp-comments", "WordPress\WpComments\WpCommentsController::getAll");
$router->post("/wp-comments", "WordPress\WpComments\WpCommentsController::insert");
$router->group("/wp-comments", function ($router) {
    $router->get("/{comment_ID:number}", "WordPress\WpComments\WpCommentsController::get");
    $router->post("/{comment_ID:number}", "WordPress\WpComments\WpCommentsController::update");
    $router->delete("/{comment_ID:number}", "WordPress\WpComments\WpCommentsController::delete");
});

$router->get("/wp-links", "WordPress\WpLinks\WpLinksController::getAll");
$router->post("/wp-links", "WordPress\WpLinks\WpLinksController::insert");
$router->group("/wp-links", function ($router) {
    $router->get("/{link_id:number}", "WordPress\WpLinks\WpLinksController::get");
    $router->post("/{link_id:number}", "WordPress\WpLinks\WpLinksController::update");
    $router->delete("/{link_id:number}", "WordPress\WpLinks\WpLinksController::delete");
});

$router->get("/wp-options", "WordPress\WpOptions\WpOptionsController::getAll");
$router->post("/wp-options", "WordPress\WpOptions\WpOptionsController::insert");
$router->group("/wp-options", function ($router) {
    $router->get("/{option_id:number}", "WordPress\WpOptions\WpOptionsController::get");
    $router->post("/{option_id:number}", "WordPress\WpOptions\WpOptionsController::update");
    $router->delete("/{option_id:number}", "WordPress\WpOptions\WpOptionsController::delete");
});

$router->get("/wp-postmeta", "WordPress\WpPostmeta\WpPostmetaController::getAll");
$router->post("/wp-postmeta", "WordPress\WpPostmeta\WpPostmetaController::insert");
$router->group("/wp-postmeta", function ($router) {
    $router->get("/{meta_id:number}", "WordPress\WpPostmeta\WpPostmetaController::get");
    $router->post("/{meta_id:number}", "WordPress\WpPostmeta\WpPostmetaController::update");
    $router->delete("/{meta_id:number}", "WordPress\WpPostmeta\WpPostmetaController::delete");
});

$router->get("/wp-posts", "WordPress\WpPosts\WpPostsController::getAll");
$router->post("/wp-posts", "WordPress\WpPosts\WpPostsController::insert");
$router->group("/wp-posts", function ($router) {
    $router->get("/{ID:number}", "WordPress\WpPosts\WpPostsController::get");
    $router->post("/{ID:number}", "WordPress\WpPosts\WpPostsController::update");
    $router->delete("/{ID:number}", "WordPress\WpPosts\WpPostsController::delete");
});

$router->get("/wp-term-relationships", "WordPress\WpTermRelationships\WpTermRelationshipsController::getAll");
$router->post("/wp-term-relationships", "WordPress\WpTermRelationships\WpTermRelationshipsController::insert");
$router->group("/wp-term-relationships", function ($router) {
    $router->get("/{object_id:number}", "WordPress\WpTermRelationships\WpTermRelationshipsController::get");
    $router->post("/{object_id:number}", "WordPress\WpTermRelationships\WpTermRelationshipsController::update");
    $router->delete("/{object_id:number}", "WordPress\WpTermRelationships\WpTermRelationshipsController::delete");
});

$router->get("/wp-term-taxonomy", "WordPress\WpTermTaxonomy\WpTermTaxonomyController::getAll");
$router->post("/wp-term-taxonomy", "WordPress\WpTermTaxonomy\WpTermTaxonomyController::insert");
$router->group("/wp-term-taxonomy", function ($router) {
    $router->get("/{term_taxonomy_id:number}", "WordPress\WpTermTaxonomy\WpTermTaxonomyController::get");
    $router->post("/{term_taxonomy_id:number}", "WordPress\WpTermTaxonomy\WpTermTaxonomyController::update");
    $router->delete("/{term_taxonomy_id:number}", "WordPress\WpTermTaxonomy\WpTermTaxonomyController::delete");
});

$router->get("/wp-termmeta", "WordPress\WpTermmeta\WpTermmetaController::getAll");
$router->post("/wp-termmeta", "WordPress\WpTermmeta\WpTermmetaController::insert");
$router->group("/wp-termmeta", function ($router) {
    $router->get("/{meta_id:number}", "WordPress\WpTermmeta\WpTermmetaController::get");
    $router->post("/{meta_id:number}", "WordPress\WpTermmeta\WpTermmetaController::update");
    $router->delete("/{meta_id:number}", "WordPress\WpTermmeta\WpTermmetaController::delete");
});

$router->get("/wp-terms", "WordPress\WpTerms\WpTermsController::getAll");
$router->post("/wp-terms", "WordPress\WpTerms\WpTermsController::insert");
$router->group("/wp-terms", function ($router) {
    $router->get("/{term_id:number}", "WordPress\WpTerms\WpTermsController::get");
    $router->post("/{term_id:number}", "WordPress\WpTerms\WpTermsController::update");
    $router->delete("/{term_id:number}", "WordPress\WpTerms\WpTermsController::delete");
});

$router->get("/wp-usermeta", "WordPress\WpUsermeta\WpUsermetaController::getAll");
$router->post("/wp-usermeta", "WordPress\WpUsermeta\WpUsermetaController::insert");
$router->group("/wp-usermeta", function ($router) {
    $router->get("/{umeta_id:number}", "WordPress\WpUsermeta\WpUsermetaController::get");
    $router->post("/{umeta_id:number}", "WordPress\WpUsermeta\WpUsermetaController::update");
    $router->delete("/{umeta_id:number}", "WordPress\WpUsermeta\WpUsermetaController::delete");
});

$router->get("/wp-users", "WordPress\WpUsers\WpUsersController::getAll");
$router->post("/wp-users", "WordPress\WpUsers\WpUsersController::insert");
$router->group("/wp-users", function ($router) {
    $router->get("/{ID:number}", "WordPress\WpUsers\WpUsersController::get");
    $router->post("/{ID:number}", "WordPress\WpUsers\WpUsersController::update");
    $router->delete("/{ID:number}", "WordPress\WpUsers\WpUsersController::delete");
});

