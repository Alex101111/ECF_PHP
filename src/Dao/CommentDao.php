<?php

namespace App\Dao;

use PDO;
use Core\AbstractDao;
use App\Model\Comment;

class CommentDao extends AbstractDao
{



/**
 * 
 * get all comments from bdd
 */




    public function getAll($article_id)
    {
        $sth = $this->dbh->prepare(
            "SELECT * FROM `comment` WHERE article_id = :article_id" 
        );
        $sth->execute([
            ":article_id" => $article_id ]);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($result); $i++) {
            $a = new Comment(); 
            $result[$i] = $a->setContent($result[$i]['content'])
                         ->setIdComment($result[$i]['id_comment'])
                         ->setArticleId($result[$i]['article_id']);
        }
        return $result;

    }

 /**
     *add comment to the bdd and assign an id to the created comment 
     *
     * @param Comment 
     */
    public function new(Comment $comment): void
    {
        $sth = $this->dbh->prepare(
            "INSERT INTO `comment` (article_id, user_id, content )
                                        VALUES (:article_id, :user_id, :content)"
        );
        $sth->execute([ 
            ':article_id' => $comment->getArticleId(),
            ':user_id' => $comment->getUserId(),
            ':content' =>$comment->getContent()
        ]);
 
        $comment->setIdComment($this->dbh->lastInsertId());
    }




    /**
     * get a comment from bdd based on id 
     *
     * @param int $id id of the comment we are getting 
     * @return Comment|null the function returns a comment or null 
     */
    public function getById(int $id): ?Comment  //'show' of controller : to display one category
    {
        $sth = $this->dbh->prepare("SELECT * FROM `comment` WHERE id_comment = :id_comment");
        $sth->execute([":id_comment" => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) return null;

        $a = new Comment();
        return $a->setIdComment($result['id_comment'])
            ->setContent($result['content']);

    }















     /**
     * edit the comment from db
     *
     * @param Comment 
     */
    public function edit(Comment $comment): void
    {
        $sth = $this->dbh->prepare(
            "UPDATE `comment` SET content = :content WHERE id_comment = :id_comment "
        );
        $sth->execute([
            ':content' => $comment->getContent(),
            ':id_comment' => $comment->getIdComment()
        
        ]);
    }



     /**
     * delete comment from bdd
     *
     * @param int $id of the comment we want to delete 
     */
    public function delete(int $id): void
    {
        $sth = $this->dbh->prepare("DELETE FROM `comment` WHERE id_comment = :id_comment");
        $sth->execute([":id_comment" => $id]);
    }



}
