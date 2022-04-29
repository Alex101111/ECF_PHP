<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';

foreach ($comments as $comment) :
    ?>
    <h1>Comment  </h1>
    <article class="p-3 border border-1 rounded mb-3" id="article">
      
        <hr>
        <p><?= nl2br(filter_var($comment->getContent(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?></p>
        <hr>
        <ul class="nav">

            <?php
            if (isset($_SESSION['user'])) :
                ?>
                <li class="nav-item me-2">
                    <a class="nav-link btn btn-light text-dark"
                       href="<?= sprintf("/comment/edit/%d", $comment->getIdComment()) ?>">Edit</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link btn btn-danger text-light"
                       href="<?= sprintf("/comment/delete/%d", $comment->getIdComment())  ?>">Delete</a>
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