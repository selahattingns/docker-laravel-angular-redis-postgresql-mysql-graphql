<?php
namespace App\Services\Pages;

use App\Interfaces\Pages\CommentInterface;
use Illuminate\Support\Facades\Auth;

class CommentService {
    /**
     * @var CommentInterface
     */
    private $commentRepository;

    /**
     * CommentService constructor.
     * @param CommentInterface $commentRepository
     */
    public function __construct(CommentInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param null $postId
     * @param null $content
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getCommentList($postId, $content = null)
    {
        return $this->commentRepository->getCommentList($postId, $content);
    }

    /**
     * @param $postId
     * @param $content
     * @return mixed
     */
    public function storeComment($postId, $content)
    {
        return $this->commentRepository->storeCommentToPost(Auth::id(), $postId, $content);
    }

    /**
     * @param $userId
     * @param $commentId
     * @return mixed
     */
    public function deleteComment($userId, $commentId)
    {
        return $this->commentRepository->deleteComment($userId, $commentId);
    }

    /**
     * @param $commentId
     * @param $content
     * @return mixed
     */
    public function updateComment($commentId, $content)
    {
        return $this->commentRepository->updateComment(Auth::id(), $commentId, $content);
    }
}
