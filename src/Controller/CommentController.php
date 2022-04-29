<?php

namespace App\Controller;

use PDOException;
use App\Model\Comment;
use App\Dao\CommentDao;

class CommentController
{

/**
 * 
 * show comment based on 
 * we use the $id of the article to get the comments specified for this article 
 */
public function index( int $id)
 {

        try {

            $commentDao = new CommentDao();
            $comments = $commentDao->getAll($id);
           
        } catch (PDOException $e) {
            echo "Oops ! I think something went wrong";
            echo "<br>";
            echo $e->getMessage();
            die;
        }
        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'comment', 'index.html.php']);
    }




/**
 * add comment to the bdd 
 * 
 */

    public function add($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }

        $args = [
            'content' => []
        ];
        $comment_post = filter_input_array(INPUT_POST, $args);

        if ( isset($comment_post['content'])) {
    
            if (empty(trim($comment_post['content']))) {
                $error_messages['danger'][] = "Contenu inexistant";
            }

            if (!isset($error_messages)) {
                $comment = new Comment();
                $comment->setArticleId($id)
                    ->setUserId($_SESSION['id_user'])
                    ->setContent($comment_post['content']);

                try {
                    $commentDao = new CommentDao();
                    $commentDao->new($comment);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    die;
                }

                header(sprintf('Location: /article/show/%d', $comment->getArticleId()));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'comment', 'new.html.php']);
    }

/**
 * 
 * edit the comments from bdd
 */

    public function edit(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }
        $commentDao = new CommentDao();
        $comment = $commentDao->getById($id);

        if (is_null($commentDao)) {
            header('Location: /');
            die;
        }
      
        $article_id = $_GET['id_article'];
    
        $args = [
            'content' => []
        ];
        $comment_post= filter_input_array(INPUT_POST, $args);


        if ( isset($comment_post['content'])) {

          
            if (empty(trim($comment_post['content']))) {
                $error_messages[] = "Contenu inexistant";
            }

            /** Vérifies que $error_messages n'existe pas */
            if (!isset($error_messages)) {

              $comment ->setContent($comment_post['content']);
                     
                $commentDao->edit($comment);
                /** Rediriges vers la page de l'article édité */

                header(sprintf('Location: /article/show/%d', $article_id));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'comment', 'edit.html.php']);
    }


    /**
     * 
     * delete comments from bdd
     */

    public function delete(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }
        $commentDao = new CommentDao();
        $commentDao->delete($id);
        header('Location: /');
        die;
    }
    }