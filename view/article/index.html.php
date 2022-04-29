<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';
$photos = [1,2,3,4];

foreach ($articles as $key=>$article) :
  
  
    ?>
    <article class="p-3 border border-1 rounded mb-3" id="article<?= $article->getIdArticle() ?>">
        <h1><?= filter_var($article->getTitle(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h1>
        <h5><?= filter_var($article->getCreatedAt(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h5>
        <hr>
        <p><?= nl2br(filter_var($article->getContent(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?></p>
        <!---------I use the loop for to iterate the numbers of photos and then use the photo based on article id --------------->
      <img src="<?php 
      for($i=0; $i < count($photos) ; $i++){
      if($article->getIdArticle() == $photos[$i]){ 
          echo $photos[$i]; }
      }?>.jpg" alt="">
        <hr>
        <ul class="nav">
            <li class="nav-item me-2">
                <a class="nav-link btn btn-primary text-light"
                   href="<?= sprintf("/article/show/%d", $article->getIdArticle()) ?>">Read</a>
            </li>
            <?php
            if (isset($_SESSION['user'])) :
                ?>
                <li class="nav-item me-2">
                    <a class="nav-link btn btn-light text-dark"
                       href="<?= sprintf("/article/edit/%d", $article->getIdArticle()) ?>">Edit</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link btn btn-danger text-light"
                       href="<?= sprintf("/article/delete/%d", $article->getIdArticle()) ?>">Delete</a>
                </li>
            <?php
            endif;
            ?>
        </ul>
    </article>
<?php
endforeach;

require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php";
?>