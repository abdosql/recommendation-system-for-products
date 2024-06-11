<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Product;
use App\Interface\ICommentService;

class CommentService implements ICommentService
{

    public function getCommentById(Comment $comment): ?Comment
    {
        // TODO: Implement getCommentById() method.
    }

    public function getAllCommentsOfProduct(Product $product): array
    {
        // TODO: Implement getAllCommentsOfProduct() method.
    }

    public function createComment(Product $product): ?Comment
    {
        // TODO: Implement createComment() method.
    }

    public function updateComment(Comment $comment, Product $product): ?Comment
    {
        // TODO: Implement updateComment() method.
    }

    public function deleteComment(Comment $comment): void
    {
        // TODO: Implement deleteComment() method.
    }
}