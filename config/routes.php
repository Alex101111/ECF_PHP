<?php

use App\Controller\{ArticleController, SigninController, SignoutController, SignupController,CommentController,PhotoController};

$router->map('GET', '/', function() {
    $articleController = new ArticleController();
    $articleController->index();
});
$router->map('GET|POST', '/article/new', function() {
    $articleController = new ArticleController();
    $articleController->new();
});
$router->map('GET', '/article/show/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->show($id);
    /** 
     * we add the comment inside the article and we use aticle id  as a parameters for the index function in comment controller that will show the comments
    */
    $commentController = new CommentController();
    $commentController->index($id);


});
$router->map('GET|POST', '/article/edit/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->edit($id);
});
$router->map('GET', '/article/delete/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->delete($id);
});
$router->map('GET|POST', '/signup', function () {
    $signupController = new SignupController();
    $signupController->index();
});
$router->map('GET|POST', '/signin', function () {
    $signinController = new SigninController();
    $signinController->index();
});
$router->map('GET|POST', '/signout', function () {
    $signoutController = new SignoutController();
    $signoutController->index();
});



$router->map('GET|POST', '/article/comment/add/[i:id]', function(int $id) {
    $commentController = new CommentController();
    $commentController->add($id);
});

$router->map('GET|POST', '/comment/edit/[i:id]', function(int $id) {
    $commentController = new CommentController();
    $commentController->edit($id);
});

$router->map('GET|POST', '/comment/delete/[i:id]', function(int $id) {
    $commentController = new CommentController();
    $commentController->delete($id);
});



$router->map('POST|GET', '/article/photo/upload', function() {
    $photoController = new PhotoController();
    $photoController->upload();
});

