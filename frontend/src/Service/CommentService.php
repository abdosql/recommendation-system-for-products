<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\Rating;
use App\Interface\ICommentService;
use Doctrine\ORM\EntityManagerInterface;

class CommentService implements ICommentService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getCommentById(Comment $comment): ?Comment
    {
        return $this->entityManager->getRepository(Comment::class)->find($comment);
    }

    public function getAllCommentsOfProduct(Product $product): array
    {
        return $this->entityManager->getRepository(Comment::class)->findAll();
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
        $comment = $this->getCommentById($comment);
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }
}