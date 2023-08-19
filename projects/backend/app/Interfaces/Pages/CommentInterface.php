<?php
namespace App\Interfaces\Pages;

interface CommentInterface {

    /**
     * @param string $postId
     * @param string $content
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getCommentList($postId, $content = null);

    /**
     * @param $userId
     * @param $postId
     * @param $content
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeCommentToPost($userId, $postId, $content);

    /**
     * @param $userId
     * @param $commentId
     * @return mixed
     */
    public function deleteComment($userId, $commentId);

    /**
     * @param $userId
     * @param $commentId
     * @param $content
     * @return int
     */
    public function updateComment($userId, $commentId, $content);
}
