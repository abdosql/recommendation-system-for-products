<?php

namespace App\Interface;

use App\Entity\Comment;
use App\Entity\Product;

interface ICommentService
{
    public function getCommentById(Comment $comment): ?Comment;
    public function getAllCommentsOfProduct(Product $product): array;
    public function createComment(Product $product): ?Comment;
    public function updateComment(Comment $comment, Product $product): ?Comment;
    public function deleteComment(Comment $comment): void;
}