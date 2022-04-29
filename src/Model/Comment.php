<?php

namespace App\Model;

use PDO;
use Core\AbstractDao;
use App\Model\Comment;

class Comment 
{

    protected int $id_comment; 
    protected int $article_id;
    protected int $user_id;
    protected string $content;
    protected int $created_at;



    /**
     * Get the value of id_comment
     *
     * @return int
     */
    public function getIdComment(): int
    {
        return $this->id_comment;
    }

    /**
     * Set the value of id_comment
     *
     * @param int $id_comment
     *
     * @return self
     */
    public function setIdComment(int $id_comment): self
    {
        $this->id_comment = $id_comment;

        return $this;
    }

    /**
     * Get the value of article_id
     *
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->article_id;
    }

    /**
     * Set the value of article_id
     *
     * @param int $article_id
     *
     * @return self
     */
    public function setArticleId(int $article_id): self
    {
        $this->article_id = $article_id;

        return $this;
    }

    /**
     * Get the value of user_id
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @param int $user_id
     *
     * @return self
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created_at
     *
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @param int $created_at
     *
     * @return self
     */
    public function setCreatedAt(int $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}