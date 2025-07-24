<?php

namespace App\Services;

use App\Repositories\CommentRepository;


class CommentService{

    protected $commentRepository;
    
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getAllComments()
    {
        return $this->commentRepository->all();
    }
    public function getCommentById($id)
    {
        return $this->commentRepository->find($id);
    }

    public function createComment(array $data)
    {
        return $this->commentRepository->create($data);
    }
    
    public function updateComment($commentId, array $data)
    {
        $comment = $this->commentRepository->find($commentId);
        return $this->commentRepository->update($comment, $data);
    }

    public function deleteComment($commentId)
    {
        $comment = $this->commentRepository->find($commentId);
        return $this->commentRepository->delete($comment);
    }
    
    public function getCommentsByProduct($productId)
    {
        return $this->commentRepository->getByProduct($productId);
    }

}