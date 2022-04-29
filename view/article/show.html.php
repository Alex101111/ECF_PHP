<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';

$photos = [1,2,3,4];
?>
    <article class="p-3 border border-1 rounded mb-3" id="article<?= $article->getIdArticle() ?>">
        <h1><?= filter_var($article->getTitle(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h1>
        
        <h5><?= filter_var($article->getCreatedAt(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h5>
        <h5>Posted by <?= filter_var($article->getUser()?->getPseudo() ?? 'Anonymous', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h5>
        <hr>
        <p><?= nl2br(filter_var($article->getContent(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?></p>
              <!---------I use the loop for to iterate the numbers of photos and then use the photo based on article id --------------->
        <img src="/<?php 
      for($i=0; $i < count($photos) ; $i++){
      if($article->getIdArticle() == $photos[$i]){ 
          echo $photos[$i]; }
      }?>.jpg" alt="">
        <?php
        if (isset($_SESSION['user'])) :
            ?>
            <hr>
            <ul class="nav">
                <li class="nav-item me-2">
                    <a class="nav-link btn btn-primary text-light"
                       href="<?= sprintf("/article/edit/%d", $article->getIdArticle()) ?>">Edit</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link btn btn-danger text-light"
                       href="<?= sprintf("/article/delete/%d", $article->getIdArticle()) ?>">Delete</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link btn btn-danger text-light"
                       href="<?= sprintf("/article/comment/add/%d", $article->getIdArticle()) ?>">Add Comment</a>
                </li>
            </ul>
        <?php
        endif;
        ?>
    </article>

    <article>
<div>
<?php require_once VIEW . DIRECTORY_SEPARATOR . 'comment' . DIRECTORY_SEPARATOR . 'index.html.php'; ?>
</div>
  
    
<?php

require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php";
?>